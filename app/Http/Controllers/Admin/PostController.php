<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class PostController extends Controller
{
    public function index()
    {
        return view('admin.post.index',[
            'maincategories'=>Category::where('parent',0)->get(),
            'posts'=>Post::all()
        ]);
    }

    public function comment()
    {
        return view('admin.post.comments',[
            'comments'=>Comment::where('post_id','!=',Null)->get()
        ]);
    }

    public function show($id){
        return view('admin.post.show',[
            'post'=>Post::where('id',$id)->first(),
        ]);
    }

    public function destroy_comment(Request $request)
    {
        $id = $request->comment_id;
        $category = Comment::find($id);
        if($category){
            $category->delete();
            return back()->with('success','تم حذف التعليق بنجاح');
        }else{
            return back()->with('faild','يوجد خطأ');
        }
    }
    public function activate_comment(Request $request)
    {
        $id = $request->comment_id;
        $category = Comment::where('id',$id)->first();
        if($category){
            $category->status=1;
            $category->save();
            return back()->with('success','تم تفعيل التعليق بنجاح');
        }else{
            return back()->with('faild','يوجد خطأ');
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'             =>  'required',
            'category_id'       =>  'required',
            'files'             =>  'required',
        ]);
        $post = new Post();
        $post->user_id               = Auth::user()->id;
        $post->category_id           = $request->category_id;
        $post->post_name             = $request->title;
        $post->post_description      = $request->description;
        $post->allow_comment         = $request->allow_comment;
        $post->type                  = 1;
        $post->save();

        $mainpath = date("Y-m-d").'/';
        $files = $request->file('files');
        if (isset($files)){
            foreach($files as $file){
                $fileNameWithExtension = $file->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $imageName = $fileName.'_'.time().'.'.$extension;
                $path = $file->move(public_path('storage/posts/'.$mainpath), $imageName);
                $entry = new Image();
                    $entry->post_id          = $post->id;
                    $entry->filename         = $imageName;
                    $entry->url              = url('').'/storage/posts/'.$mainpath.$imageName;
                $entry->save();
            }
        } else {
            $entry = new Image();
            $name = 'none.png';
            $entry->post_id   = $post->id;
            $entry->url = url('').'/storage/posts/'.$name;
            $entry->save();
        }
        return back()->with('success','تم اضافة المنشور بنجاح');
    }
    public function update(Request $request)
    {
        $request->validate([
            'title'             =>  'required',
        ]);
        $id = $request->article_id;
        $post = Post::find($id);
        $post->post_name          = $request->title;
        $post->post_description   = $request->description;
        $post->allow_comment      = $request->allow_comment;
        $post->save();
        $mainpath = date("Y-m-d").'/';
        $files = $request->file('files');
        if (isset($files)){
            foreach($files as $file){
                $fileNameWithExtension = $file->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $imageName = $fileName.'_'.time().'.'.$extension;
                $path = $file->move(public_path('storage/posts/'.$mainpath), $imageName);
                $entry = new Image();
                    $entry->post_id            = $post->id;
                    $entry->filename            = $imageName;
                    $entry->url                 = url('').'/storage/posts/'.$mainpath.$imageName;
                $entry->save();
            }
        } else {
            $entry = new Image();
            $name = 'none.png';
            $entry->post_id   = $post->id;
            $entry->url = url('').'/storage/posts/'.$name;
            $entry->save();
        }
        return back()->with('success','تم تعديل المنشور بنجاح');
    }
    public function destroy(Request $request){
        $article = Post::where('id',$request->article_id)->first();
        if($article){
            $images = Image::where('post_id',$request->article_id)->get();
            foreach ($images as $image) {
                if ($image->filename != 'none.png'){
                    $timestamp = strtotime($image->created_at);
                    $date = date('Y-m-d', $timestamp);
                    if(File::exists(public_path('storage/posts/'.$date.'/'.$image->filename))){
                        File::delete(public_path('storage/posts/'.$date.'/'.$image->filename));
                    }else{
                        return back()->with('faild',"لا يمكنك حذف المنشور");
                    }
                }
                $imageMain = Image::where('id',$image->id)->first();
                $imageMain->delete();
            }
            $article->delete();
            return back()->with('success','تم حذف المنشور بنجاح');
        } else{
            return back()->with('faild','المنشور غير موجود');
        }
    }
    public function deleteImage(Request $request){
        $images = Image::where('post_id' , $request->post_id)->get();
        if($images->count() > 1){
            $image = Image::where('id',$request->image_id)->first();
            if ($image->filename != 'none.png'){
                $timestamp = strtotime($image->created_at);
                $date = date('Y-m-d', $timestamp);
                if(File::exists(public_path('storage/posts/'.$date.'/'.$image->filename))){
                    File::delete(public_path('storage/posts/'.$date.'/'.$image->filename));
                }else{
                    return back()->with('faild',"لا يمكنك حذف الصورة");
                }
            }
            $imageMain = Image::where('id',$image->id)->first();
            $imageMain->delete();
            return back()->with('success','تم حذف الصورة بنجاح');
        } else {
            return back()->with('faild','اخر صورة لا يمكن حذفها');
        }
    }
}
