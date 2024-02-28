<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Message;
use App\Models\Top;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $article = Article::where('type', 0)->latest()->paginate(4);
        $tops = Top::all();
        return view('web.home.index', [
            'articles' => $article,
            'tops' => $tops
        ]);
    }
    public function freelessons()
    {
        return view('web.lessons.free');
    }
    public function freearticles()
    {
        $article = Article::where('type', 0)->latest()->get();
        return view('web.articles.free', [
            'articles' => $article
        ]);
    }
    public function contactus()
    {
        return view('web.contactus.index');
    }
    public function login()
    {
        return view('web.auth.login');
    }
    public function register()
    {
        return view('web.auth.register');
    }
    public function addMessage(Request $request)
    {
        $request->validate([
            'username'          =>  'required',
            'message'           =>  'required',
        ]);
        $message = new Message();
        $message->message = $request->message;
        $message->username = $request->username;
        $message->phone = $request->phone;
        $message->save();
        return back()->with('success', 'تم اضافة الرسالة بنجاح');
    }
}
