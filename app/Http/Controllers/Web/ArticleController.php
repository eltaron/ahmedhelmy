<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->status == 1) {
            $articles = Article::where('category_id', Auth::user()->groupid)->orderBy('id', 'DESC')->get();
            return view('web.articles.index', [
                'articles' => $articles
            ]);
        } else {
            return redirect(url('under_review/' . Auth::user()->username));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->status == 1) {
            $article = Article::find($id);
            if ($article) {
                return view('web.articles.show', [
                    'article' => $article
                ]);
            } else {
                return redirect(url('error-404/'));
            }
        } else {
            return redirect(url('under_review/' . Auth::user()->username));
        }
    }

    public function addComment(Request $request)
    {
        $request->validate([
            'comment'          =>  'required',
            'article_id'          =>  'required',
        ]);
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->status  = 0;
        $comment->user_id = Auth::user()->id;
        $comment->article_id = $request->article_id;
        $comment->save();
        return back()->with('success', 'تم اضافة التعليق بنجاح في انتظار التفعيل');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
