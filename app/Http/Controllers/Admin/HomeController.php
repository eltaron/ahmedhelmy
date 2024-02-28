<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            return redirect(url('admin/dashboard'));
        } else {
            return view('admin.home.index');
        }
    }
    public function relodBack()
    {
        if (Auth::user()->only == 1) {
            return redirect(aurl('lessons'))->with('success', 'تم اضافة الدرس بنجاح');
        } else {
            return redirect(url('error-404/'));
        }
    }
    public function dashboard()
    {
        $users = User::where('only', '!=', 1)->latest()->paginate(10);
        $lessons = Lesson::latest()->paginate(10);
        $messages = Message::latest()->paginate(10);
        return view('admin.home.dashboard', [
            'users' => $users,
            'lessons' => $lessons,
            'messages' => $messages,
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect(url(""));
    }

    public function Notfound()
    {
        return view('admin.includes.404_page');
    }
}
