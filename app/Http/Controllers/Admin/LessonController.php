<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\Lesson_member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class LessonController extends Controller
{
    public function index()
    {
        return view('admin.lesson.index', [
            'lessons' => Lesson::all(),
            'maincategories' => Category::where('parent', 0)->get(),
        ]);
    }

    public function show($id)
    {
        $lesson = Lesson::where('id', $id)->first();
        if ($lesson->category->parent == 0) {
            $mainCtegoryId = Category::where('parent', $lesson->category_id)->pluck('id')->toArray();
            $usersLessons = Lesson_member::where('lesson_id', $lesson->id)->pluck('user_id')->toArray();
            $users = User::whereIn('groupid', $mainCtegoryId)->whereNotIn('id', $usersLessons)->get();
        } else {
            $usersLessons = Lesson_member::where('lesson_id', $lesson->id)->pluck('user_id')->toArray();
            $users = User::where('groupid', $lesson->category_id)->whereNotIn('id', $usersLessons)->get();
        }
        return view('admin.lesson.show', [
            'lesson' => $lesson,
            'mainusers' => $users,
            'comments' => Comment::where('lesson_id', '!=', Null)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         =>  'required',
            'video'        =>  'required',
            'category_id'  =>  'required',
        ]);
        $lesson = new Lesson();
        $lesson->user_id             = Auth::user()->id;
        $lesson->category_id         = $request->category_id;
        $lesson->lesson_name         = $request->name;
        $lesson->lesson_description  = $request->description;
        $lesson->allow_comment       = $request->allow_comment;
        $lesson->approve             = $request->allow_exam;
        $lesson->status              = 1;
        $mainpath = date("Y-m-d") . '/';
        $video = $request->file('video');
        if (isset($video)) {
            $fileNameWithExtension = $video->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $video->getClientOriginalExtension();
            $imageName = $fileName . '_' . time() . '.' . $extension;
            $path = $video->move(public_path('storage/lessons/videos/' . $mainpath), $imageName);
            $lesson->video       = url('') . '/storage/lessons/videos/' . $mainpath . $imageName;
            $lesson->vfilename   = $imageName;
        }

        $imagethumb = $request->file('imagethumb');
        if (isset($video)) {
            $fileNameWithExtension = $imagethumb->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $imagethumb->getClientOriginalExtension();
            $imageName = $fileName . '_' . time() . '.' . $extension;
            $path = $imagethumb->move(public_path('storage/lessons/videos/imagethumb/' . $mainpath), $imageName);
            $lesson->imagethumb       = url('') . '/storage/lessons/videos/imagethumb/' . $mainpath . $imageName;
        }
        $file = $request->file('file');
        if (isset($file)) {
            $fileNameWithExtension = $file->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $imageName = $fileName . '_' . time() . '.' . $extension;
            $path = $file->move(public_path('storage/lessons/pdfs/' . $mainpath), $imageName);
            $lesson->pdf         = url('') . '/storage/lessons/pdfs/' . $mainpath . $imageName;
            $lesson->pdffilename = $imageName;
        }
        $lesson->save();
        return back()->with('success', 'تم اضافة الدرس بنجاح');
    }

    public function store2(Request $request)
    {
        $request->validate([
            'name'         =>  'required',
            'link'         =>  'required',
            'category_id'  =>  'required',
        ]);
        $lesson = new Lesson();
        $lesson->user_id             = Auth::user()->id;
        $lesson->category_id         = $request->category_id;
        $lesson->lesson_name         = $request->name;
        $lesson->lesson_description  = $request->description;
        $lesson->allow_comment       = $request->allow_comment;
        $lesson->approve             = $request->allow_exam;
        $lesson->video_name          = $request->link;
        $lesson->status              = 1;
        $mainpath = date("Y-m-d") . '/';
        $file = $request->file('file');
        if (isset($file)) {
            $fileNameWithExtension = $file->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $imageName = $fileName . '_' . time() . '.' . $extension;
            $path = $file->move(public_path('storage/lessons/pdfs/' . $mainpath), $imageName);
            $lesson->pdf         = url('') . '/storage/lessons/pdfs/' . $mainpath . $imageName;
            $lesson->pdffilename = $imageName;
        }
        $lesson->save();
        return back()->with('success', 'تم اضافة الدرس بنجاح');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'         =>  'required',
        ]);
        $lesson = Lesson::find($request->lesson_id);
        $lesson->lesson_name         = $request->name;
        $lesson->lesson_description  = $request->description;
        $lesson->allow_comment       = $request->allow_comment;
        $lesson->approve             = $request->allow_exam;
        $lesson->save();
        return back()->with('success', 'تم تعديل الدرس بنجاح');
    }

    public function destroy(Request $request)
    {
        $lesson = Lesson::where('id', $request->lesson_id)->first();
        if ($lesson) {
            $timestamp = strtotime($lesson->created_at);
            $date = date('Y-m-d', $timestamp);
            if ($lesson->video) {
                if (File::exists(public_path('storage/lessons/videos/' . $date . '/' . $lesson->vfilename))) {
                    File::delete(public_path('storage/lessons/videos/' . $date . '/' . $lesson->vfilename));
                } else {
                    return back()->with('faild', "حدث خطأ في حذف الفيديو");
                }
            }
            if ($lesson->pdf) {
                if (File::exists(public_path('storage/lessons/pdfs/' . $date . '/' . $lesson->pdffilename))) {
                    File::delete(public_path('storage/lessons/pdfs/' . $date . '/' . $lesson->pdffilename));
                } else {
                    return back()->with('faild', "حدث خطأ في حذف الملفات الملحقة");
                }
            }
            $lesson->delete();
            return back()->with('success', 'تم حذف الدرس بنجاح');
        } else {
            return back()->with('faild', 'الدرس غير موجود');
        }
    }

    public function activate(Request $request)
    {
        $id = $request->lesson_id;
        $lesson = Lesson::where('id', $id)->first();
        if ($lesson) {
            $lesson->status = 1;
            $lesson->save();
            return back()->with('success', 'تم تفعيل الدرس بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }

    public function not_activiate(Request $request)
    {
        $id = $request->lesson_id;
        $lesson = Lesson::where('id', $id)->first();
        if ($lesson) {
            $lesson->status = 0;
            $lesson->save();
            return back()->with('success', 'تم تفعيل الدرس بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }
}
