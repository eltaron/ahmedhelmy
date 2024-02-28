<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\Lesson_member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class LessonController extends Controller
{
    public function index($id)
    {
        if (Auth::user()->status == 1) {
            $category = Category::find($id);
            if ($category) {
                return view('web.lessons.index', ['category' => $category]);
            } else {
                return redirect(url('error-404/'));
            }
        } else {
            return redirect(url('under_review/' . Auth::user()->username));
        }
    }

    public function show($id)
    {
        if (Auth::user()->status == 1) {
            $lesson = Lesson::find($id);
            $lessonUser = Lesson_member::where('lesson_id', $id)->where('user_id', Auth::user()->id)->first();
            if ($lesson) {
                if ($lesson->approve == 0) {
                    $timestamp = strtotime($lesson->created_at);
                    $date = date('Y-m-d', $timestamp);
                    $filename = $lesson->vfilename;
                    $path = File::exists(public_path('storage/lessons/videos/' . $date . '/' . $lesson->vfilename));
                    if ($path) {
                        $path = asset('storage/lessons/videos/' . $date . '/' . $lesson->vfilename);
                        return view('web.lessons.show', [
                            'lesson' => $lesson,
                            'lessonUser' => $lessonUser,
                            'path' => $path
                        ]);
                    } else {
                        abort(404);
                    }
                } else {
                    $answer = Answer::where('user_id', Auth::user()->id)->where('exam_id', $lesson->exam->id)->first();
                    if ($answer and $answer->mark >= 0.5 * $answer->fullmark) {
                        $timestamp = strtotime($lesson->created_at);
                        $date = date('Y-m-d', $timestamp);
                        $filename = $lesson->vfilename;
                        $path = File::exists(public_path('storage/lessons/videos/' . $date . '/' . $lesson->vfilename));
                        if ($path) {
                            $path = asset('storage/lessons/videos/' . $date . '/' . $lesson->vfilename);
                            return view('web.lessons.show', [
                                'lesson' => $lesson,
                                'lessonUser' => $lessonUser,
                                'path' => $path
                            ]);
                        } else {
                            abort(404);
                        }
                    } else {
                        return redirect(url('lessons/isntAvailable'));
                    }
                    return redirect(url('lessons/isntAvailable'));
                }
            } else {
                return redirect(url('error-404/'));
            }
        } else {
            return redirect(url('under_review/' . Auth::user()->username));
        }
    }

    public function isntAvailable()
    {
        return view('web.lessons.isntAvailable');
    }

    public function addComment(Request $request)
    {
        $request->validate([
            'comment'          =>  'required',
            'lesson_id'        =>  'required',
        ]);
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->status  = 0;
        $comment->user_id = Auth::user()->id;
        $comment->lesson_id = $request->lesson_id;
        $comment->save();
        return back()->with('success', 'تم اضافة التعليق بنجاح في انتظار التفعيل');
    }

    public function startLesson(Request $request)
    {
        $request->validate([
            'lesson_id'        =>  'required',
        ]);
        $lesson = new Lesson_member();
        $lesson->type = 1;
        $lesson->user_id = Auth::user()->id;
        $lesson->lesson_id = $request->lesson_id;
        $lesson->save();
        return back()->with('success', 'تم بدء الدرس بنجاح لا تنسي انهاء الدرس بعد الانتهاء');
    }

    public function endLesson(Request $request)
    {
        $request->validate([
            'lesson_id'        =>  'required',
        ]);
        $lesson = Lesson_member::where('lesson_id', $request->lesson_id)->where('user_id', Auth::user()->id)->first();
        $lesson->type = 2;
        $lesson->end_at = now();
        $lesson->save();
        return back()->with('success', 'تم انهاء الدرس بنجاح');
    }
}
