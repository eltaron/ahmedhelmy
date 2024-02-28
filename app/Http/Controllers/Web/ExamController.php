<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{

    public function index($id)
    {
        if (Auth::user()->status == 1) {
            $exam = Exam::find($id);
            $mark = Answer::where('user_id', Auth::user()->id)->where('exam_id', $id)->first();
            if ($mark) {
                return redirect(url('exams/isntAvailable/'));
            } else {
                if ($exam) {
                    return view('web.exams.index', [
                        'exam' => $exam
                    ]);
                } else {
                    return redirect(url('error-404/'));
                }
            }
        } else {
            return redirect(url('under_review/' . Auth::user()->username));
        }
    }

    public function full_exam($id)
    {
        if (Auth::user()->status == 1) {
            $exam = Exam::find($id);
            $mark = Answer::where('user_id', Auth::user()->id)->where('exam_id', $id)->first();
            if ($mark) {
                return redirect(url('exams/isntAvailable'));
            } else {
                if ($exam) {
                    return view('web.exams.full_exam', [
                        'exam' => $exam
                    ]);
                } else {
                    return redirect(url('error-404/'));
                }
            }
        } else {
            return redirect(url('under_review/' . Auth::user()->username));
        }
    }
    public function time_out()
    {
        return view('web.exams.time_out');
    }
    public function end($id)
    {
        $mark = Answer::find($id);
        if ($mark) {
            return view('web.exams.end', ['mark' => $mark]);
        } else {
            return redirect(url('error-404/'));
        }
    }

    public function isntAvailable()
    {
        return view('web.exams.isntAvailable');
    }

    public function endFullExam(Request $request, $id)
    {
        if (Auth::user()->status == 1) {
            $exam = Exam::find($id);
            $mmm = 0;
            $fullmark = 0;
            $mark = Answer::where('user_id', Auth::user()->id)->where('exam_id', $id)->first();
            if ($mark) {
                return redirect(url('exams/isntAvailable/'));
            } else {
                $request->validate([
                    'quesNumber'      => 'required',
                ]);
                $n = $request->quesNumber;
                for ($x = 0; $x <= $n; $x++) {
                    $answer   = $request['answer' . $x];
                    $question = $request['question' . $x];
                    if ($question && $answer) {
                        $mquestion = Question::find($question);
                        if ($answer == $mquestion->right_answer || $answer == $mquestion->answer) {
                            $mmm += 1;
                        }
                    }
                }
                $marks = new Answer();
                $marks->mark = $mmm;
                $marks->user_id  = Auth::user()->id;
                $marks->exam_id  = $id;
                $marks->groupid = Auth::user()->groupid;
                $marks->name  = Auth::user()->name;
                $marks->team = Auth::user()->category->category_name;
                $marks->fullmark = $exam->number;
                $marks->save();
                return redirect(url('exams/end/' . $marks->id));
            }
        } else {
            return redirect(url('under_review/' . Auth::user()->username));
        }
    }
}
