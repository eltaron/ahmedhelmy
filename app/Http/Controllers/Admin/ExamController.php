<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Exam;
use App\Models\Exam_part;
use App\Models\Lesson;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Hash;

class ExamController extends Controller
{
    public function index()
    {
        return view('admin.exam.index', [
            'maincategories' => Category::where('parent', 0)->get(),
            'partExams' => Exam::where('type', 0)->get(),
            'fullExams' => Exam::where('type', '!=', 0)->get(),
            'lessons' => Lesson::where('approve', 1)->get()
        ]);
    }

    public function show($id)
    {
        return view('admin.exam.show', [
            'exam' => Exam::where('id', $id)->first(),
            'answers' => Answer::where('exam_id', $id)->with(['user' => function ($query) {
                $query->orderBy('groupDay')->orderBy('groupTime');
            }])->orderby('mark', 'desc')->get(),
            'Questions' => Question::where('exam_id', $id)->get()
        ]);
    }

    public function part($id)
    {
        return view('admin.exam.part', [
            'exam' => Exam::where('id', $id)->first(),
            'answers' => Answer::where('exam_id', $id)->with(['user' => function ($query) {
                $query->orderBy('groupDay')->orderBy('groupTime');
            }])->orderby('mark', 'desc')->get(),
            'parts' => Exam_part::where('exam_id', $id)->get()
        ]);
    }

    public function partDescription($id)
    {
        return view('admin.exam.partDescription', [
            'Questions' => Question::where('part_id', $id)->get(),
            'part' => Exam_part::where('id', $id)->first()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             =>  'required',
            'lesson'            =>  'required',
        ]);
        $exam = new Exam();
        $exam->exam_name    = $request->title;
        $exam->type         = 0;
        $exam->user_id      = Auth::user()->id;
        $exam->exam_desc    = $request->description;
        $exam->lesson_id    = $request->lesson;
        if ($request->number) {
            $exam->number = $request->number;
        }
        if ($request->time) {
            $exam->time = $request->time;
        }
        $exam->save();
        return back()->with('success', 'تم اضافة الامتحان بنجاح');
    }

    public function store2(Request $request)
    {
        $request->validate([
            'title'             =>  'required',
            'category_id'       =>  'required',
            'link'              =>  'required',
        ]);
        $exam = new Exam();
        $exam->exam_name    = $request->title;
        $exam->type         = 2;
        $exam->user_id      = Auth::user()->id;
        $exam->category_id  = $request->category_id;
        $exam->exam_desc    = $request->link;
        $exam->save();
        return back()->with('success', 'تم اضافة الامتحان بنجاح');
    }

    public function store3(Request $request)
    {
        $request->validate([
            'title'             =>  'required',
            'category_id'       =>  'required',
        ]);
        $exam = new Exam();
        $exam->exam_name    = $request->title;
        $exam->type         = 1;
        $exam->user_id      = Auth::user()->id;
        $exam->category_id  = $request->category_id;
        $exam->exam_desc    = $request->description;
        if ($request->number) {
            $exam->number = $request->number;
        }
        if ($request->time) {
            $exam->time = $request->time;
        }
        $exam->save();
        return back()->with('success', 'تم اضافة الامتحان بنجاح');
    }

    public function update(Request $request)
    {
        $exam = Exam::find($request->exam_id);
        $exam->exam_name    = $request->title;
        $exam->exam_desc    = $request->description;
        $exam->lesson_id    = $request->lesson;
        if ($request->number) {
            $exam->number = $request->number;
        }
        if ($request->time) {
            $exam->time = $request->time;
        }
        $exam->save();
        return back()->with('success', 'تم تعديل الامتحان بنجاح');
    }

    public function update2(Request $request)
    {
        $exam = Exam::find($request->exam_id);
        $exam->exam_name    = $request->title;
        $exam->exam_desc    = $request->description;
        $exam->category_id  = $request->category_id;
        if ($request->number) {
            $exam->number = $request->number;
        }
        if ($request->time) {
            $exam->time = $request->time;
        }
        $exam->save();
        return back()->with('success', 'تم تعديل الامتحان بنجاح');
    }

    public function update3(Request $request)
    {
        $exam = Exam::find($request->exam_id);
        $exam->exam_name    = $request->title;
        $exam->exam_desc    = $request->description;
        $exam->category_id  = $request->category_id;
        $exam->save();
        return back()->with('success', 'تم تعديل الامتحان بنجاح');
    }

    public function destroy(Request $request)
    {
        $id = $request->exam_id;
        $exam = Exam::find($id);
        if ($exam) {
            $exam->delete();
            return back()->with('success', 'تم حذف الامتحان بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }

    public function marks(Request $request)
    {
        $answers = Answer::where('exam_id', $request->exam_id)->orderby('groupid')->orderby('mark', 'desc')->get();
        return response()->json(array('answers' => $answers));
    }

    public function storeQuestion1(Request $request)
    {
        $request->validate([
            'question'    =>  'required',
            'ans_1'       =>  'required',
            'ans_2'       =>  'required',
            'ans_3'       =>  'required',
            'ans_4'       =>  'required',
            'rightAns'    =>  'required',
        ]);
        $question = new Question();
        $question->question  = $request->question;
        $question->answer_1  = $request->ans_1;
        $question->answer_2  = $request->ans_2;
        $question->answer_3  = $request->ans_3;
        $question->answer_4  = $request->ans_4;
        $question->exam_id   = $request->exam_id;
        if ($request->rightAns == 1) {
            $question->right_answer   = $request->ans_1;
        } elseif ($request->rightAns == 2) {
            $question->right_answer   = $request->ans_2;
        } elseif ($request->rightAns == 3) {
            $question->right_answer   = $request->ans_3;
        } elseif ($request->rightAns == 4) {
            $question->right_answer   = $request->ans_4;
        }
        $mainpath = date("Y-m-d") . '/';
        $image = $request->file('image');
        if (isset($image)) {
            $fileNameWithExtension = $image->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $imageName = $fileName . '_' . time() . '.' . $extension;
            $path = $image->move(public_path('storage/ques/' . $mainpath), $imageName);
            $question->filename  = $imageName;
            $question->image     = url('') . '/storage/ques/' . $mainpath . $imageName;
        }
        $question->save();
        return back()->with('success', 'تم اضافة السؤال بنجاح');
    }

    public function storeQuestion2(Request $request)
    {
        $request->validate([
            'question'    =>  'required',
            'ans_1'       =>  'required',
        ]);
        $question = new Question();
        $question->question       = $request->question;
        $question->answer         = $request->ans_1;
        $question->exam_id        = $request->exam_id;
        $question->save();
        return back()->with('success', 'تم اضافة السؤال بنجاح');
    }

    public function destroyQuestion(Request $request)
    {
        $id = $request->ques_id;
        $ques = Question::find($id);
        if ($ques) {
            $timestamp = strtotime($ques->created_at);
            $date = date('Y-m-d', $timestamp);
            if (File::exists(public_path('storage/ques/' . $date . '/' . $ques->filename))) {
                File::delete(public_path('storage/ques/' . $date . '/' . $ques->filename));
            }
            $ques->delete();
            return back()->with('success', 'تم حذف السؤال بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }

    public function storePart(Request $request)
    {
        $request->validate([
            'part'    =>  'required',
        ]);
        $part = new Exam_part();
        $part->part_name       = $request->part;
        $part->exam_id         = $request->exam_id;
        $mainpath = date("Y-m-d") . '/';
        $image = $request->file('image');
        if (isset($image)) {
            $fileNameWithExtension = $image->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $imageName = $fileName . '_' . time() . '.' . $extension;
            $path = $image->move(public_path('storage/parts/' . $mainpath), $imageName);
            $part->filename  = $imageName;
            $part->photo     = url('') . '/storage/parts/' . $mainpath . $imageName;
        }
        $part->save();
        return back()->with('success', 'تم اضافة الجزء بنجاح');
    }

    public function destroyPart(Request $request)
    {
        $id = $request->part_id;
        $part = Exam_part::find($id);
        if ($part) {
            $timestamp = strtotime($part->created_at);
            $date = date('Y-m-d', $timestamp);
            if (File::exists(public_path('storage/parts/' . $date . '/' . $part->filename))) {
                File::delete(public_path('storage/parts/' . $date . '/' . $part->filename));
            }
            $part->delete();
            return back()->with('success', 'تم حذف الجزء بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }

    public function storePQuestion1(Request $request)
    {
        $request->validate([
            'question'    =>  'required',
            'ans_1'       =>  'required',
            'ans_2'       =>  'required',
            'ans_3'       =>  'required',
            'ans_4'       =>  'required',
            'rightAns'    =>  'required',
        ]);
        $question = new Question();
        $question->question  = $request->question;
        $question->answer_1  = $request->ans_1;
        $question->answer_2  = $request->ans_2;
        $question->answer_3  = $request->ans_3;
        $question->answer_4  = $request->ans_4;
        $question->part_id   = $request->exam_id;
        if ($request->rightAns == 1) {
            $question->right_answer   = $request->ans_1;
        } elseif ($request->rightAns == 2) {
            $question->right_answer   = $request->ans_2;
        } elseif ($request->rightAns == 3) {
            $question->right_answer   = $request->ans_3;
        } elseif ($request->rightAns == 4) {
            $question->right_answer   = $request->ans_4;
        }
        $mainpath = date("Y-m-d") . '/';
        $image = $request->file('image');
        if (isset($image)) {
            $fileNameWithExtension = $image->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $imageName = $fileName . '_' . time() . '.' . $extension;
            $path = $image->move(public_path('storage/ques/' . $mainpath), $imageName);
            $question->filename  = $imageName;
            $question->image     = url('') . '/storage/ques/' . $mainpath . $imageName;
        }
        $question->save();
        return back()->with('success', 'تم اضافة السؤال بنجاح');
    }

    public function storePQuestion2(Request $request)
    {
        $request->validate([
            'question'    =>  'required',
            'ans_1'       =>  'required',
        ]);
        $question = new Question();
        $question->question       = $request->question;
        $question->answer         = $request->ans_1;
        $question->part_id        = $request->exam_id;
        $question->save();
        return back()->with('success', 'تم اضافة السؤال بنجاح');
    }
    public function deleteAnswers($id)
    {
        if (Auth::user()->only == 1) {
            $answers = Answer::where('exam_id', $id)->get();
            if ($answers) {
                foreach ($answers as $answer) {
                    $answer->delete();
                }

                return back()->with('success', 'تم حذف النتيجة بنجاح');
            } else {
                return back()->with('faild', 'يوجد خطأ');
            }
        } else {
            return redirect(url('error-404/'));
        }
    }
}
