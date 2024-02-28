<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return view('admin.message.index',[
            'messages1'=>Message::where('user_id', '!=', Null)->get(),
            'messages2'=>Message::where('user_id', Null)->get(),
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->message_id;
        $message = Message::find($id);
        if($message){
            $message->delete();
            return back()->with('success','تم حذف الرسالة بنجاح');
        }else{
            return back()->with('faild','يوجد خطأ');
        }
    }
}
