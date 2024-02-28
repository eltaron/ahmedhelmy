<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use File;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->status == 1) {
            return view('web.users.index', [
                'answers' => Answer::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get()
            ]);
        } else {
            return redirect(url('under_review/' . Auth::user()->username));
        }
    }


    public function update(Request $request)
    {
        $request->validate([
            'user'      => 'required',
            'uname'     => 'required',
            'password'  => 'required',
            'phone'     => 'required',
        ], [
            'uname.required'     => 'يجب ادخال اسم المستخدم',
            'password.required'  => 'يجب ادخال كلمة المرور',
            'phone.required'     => 'يجب ادخال رقم الهاتف',
        ]);
        $user = User::find(decrypt($request->user));
        $user->name     = $request->uname;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'تم تعديل الحساب ');
    }
    public function avatar(Request $request)
    {
        $request->validate([
            'user'      => 'required',
            'avatar'     => 'required',
        ]);
        $user = User::find(decrypt($request->user));
        if ($user->avatar) {
            $timestamp = strtotime($user->updated_at);
            $date = date('Y-m-d', $timestamp);
            if (File::exists(public_path('storage/users/' . $date . '/' . $user->filename))) {
                File::delete(public_path('storage/users/' . $date . '/' . $user->filename));
            } else {
                return back()->with('faild', "لا يمكنك اضافة صورة");
            }
        }
        $mainpath = date("Y-m-d") . '/';
        $file = $request->file('avatar');
        if ($file) {
            $fileNameWithExtension = $file->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $imageName = $fileName . '_' . time() . '.' . $extension;
            $path = $file->move(public_path('storage/users/' . $mainpath), $imageName);
            $user->filename           = $imageName;
            $user->avatar           = url('') . '/storage/users/' . $mainpath . $imageName;
        }
        $user->updated_at = now();
        $user->save();
        return back()->with('success', 'تم اضافة صورة بنجاح ');
    }
    public function contact(Request $request)
    {
        $request->validate([
            'user'      => 'required',
            'message'   => 'required',
        ]);
        $message = new Message();
        $message->user_id      = decrypt($request->user);
        $message->message      = $request->message;
        $message->save();
        return back()->with('success', 'تم اضافة الرسالة بنجاح');
    }
}
