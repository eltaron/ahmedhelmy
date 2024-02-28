<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->status == 1) {
            $posts = Post::whereIn('category_id', [Auth::user()->groupid, Auth::user()->category->parent])->withCount('comments')->orderBy('id', 'DESC')->get();
            return view('web.posts.index', [
                'posts' => $posts
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
        //
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
    public function addComment(Request $request)
    {
        $request->validate([
            'comment'          =>  'required',
            'post_id'          =>  'required',
        ]);
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->status  = 0;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->save();
        return back()->with('success', 'تم اضافة التعليق بنجاح في انتظار التفعيل');
    }
    public function like(Request $request)
    {
        try {
            $post = Post::find($request->blog_id);
            $post->likecount += 1;
            $post->save();
            return 'success';
        } catch (\Exception $ex) {
            return $ex;
        }
    }
}
