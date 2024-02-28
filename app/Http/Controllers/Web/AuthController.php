<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signupnow()
    {
        return view('web.auth.signupnow');
    }
    public function under_review($code)
    {
        return view('web.auth.under_review', ['code' => $code]);
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'user_login' => 'required',
            'user_pass' => 'required',
        ]);
        if (Auth::attempt(['username' => $request->user_login, 'password' => $request->user_pass, 'status' => 1])) {
            if (session()->has('previous-url')) {
                return redirect(session('previous-url'))->with('تم تسجيل الدخول بنجاح');
            } else {
                return redirect(url('dashboard'))->with('success', 'تم تسجيل الدخول بنجاح');
            }
        }
        return back()->with('faild', 'يوجد خطأ بالبيانات');
    }
    public function store(Request $request)
    {
        $request->validate([
            'phone'         => 'required',
            'password'      => 'required',
            'parent'        => 'required',
        ], [
            'phone'         => 'يجب ادخال رقم الهاتف  ',
            'password'      => 'يرجي ادخال كلمة المرور',
            'parent'        => 'يرجي اختيار القسم',
        ]);
        $username = $this->generateCodeNumber();
        $user = new User();
        $user->name     = $request->username;
        $user->groupid  = $request->parent;
        $user->phone    = $request->phone;
        $user->mac      = $request->ip();
        $user->status   = 0;
        $user->password = Hash::make($request->password);
        $user->username = $username;
        $user->save();
        $notificaton = new Notification();
        $notificaton->user_id  = $user->id;
        $notificaton->content  = 'تم اضافة مستخدم جديد';
        $notificaton->model    = 'User';
        $notificaton->type     = 'newUser';
        $notificaton->model_id = $user->id;
        $notificaton->save();
        Auth::login($user);
        return redirect(url('under_review/' . $username))->with('success', 'تم انشاء حساب ');
    }
    function generateCodeNumber()
    {
        $number = mt_rand(10000000, 99999999);
        if ($this->barcodeNumberExists($number)) {
            return $this->generateCodeNumber();
        }
        return $number;
    }

    function barcodeNumberExists($number)
    {
        return User::where('username', $number)->exists();
    }
    public function logout()
    {
        Auth::logout();
        return redirect(url(""));
    }
}
