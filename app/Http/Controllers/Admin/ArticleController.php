<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use File;

class ArticleController extends Controller
{
    public function index()
    {
        return view('admin.article.index', [
            'maincategories' => Category::where('parent', 0)->get(),
            'articles' => Article::all(),
        ]);
    }
    public function free2()
    {
        return view('admin.article.index', [
            'maincategories' => Category::where('parent', 0)->get(),
            'articles' => Article::where('type', 0)->get(),
        ]);
    }
    public function notfree2()
    {
        return view('admin.article.index', [
            'maincategories' => Category::where('parent', 0)->get(),
            'articles' => Article::where('type', 1)->get(),
        ]);
    }
    public function comment()
    {
        return view('admin.article.comments', [
            'comments' => Comment::where('article_id', '!=', Null)->get(),
        ]);
    }

    public function show($id)
    {
        return view('admin.article.show', [
            'article' => Article::where('id', $id)->first(),
        ]);
    }
    public function destroy_comment(Request $request)
    {
        $id = $request->comment_id;
        $category = Comment::find($id);
        if ($category) {
            $category->delete();
            return back()->with('success', 'تم حذف التعليق بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }
    public function activate_comment(Request $request)
    {
        $id = $request->comment_id;
        $category = Comment::where('id', $id)->first();
        if ($category) {
            $category->status = 1;
            $category->save();
            return back()->with('success', 'تم تفعيل التعليق بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'             =>  'required',
            'category_id'       =>  'required',
            'files'             =>  'required',
        ]);
        $article = new Article();
        $article->user_id               = Auth::user()->id;
        $article->category_id           = $request->category_id;
        $article->article_name          = $request->title;
        $article->article_description   = $request->description;
        $article->allow_comment         = $request->allow_comment;
        $article->type                  = 1;
        $article->save();
        $mainpath = date("Y-m-d") . '/';
        $files = $request->file('files');
        if (isset($files)) {
            foreach ($files as $file) {
                $fileNameWithExtension = $file->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $imageName = $fileName . '_' . time() . '.' . $extension;
                $path = $file->move(public_path('storage/articles/' . $mainpath), $imageName);
                $entry = new Image();
                $entry->article_id          = $article->id;
                $entry->filename            = $imageName;
                $entry->url                 = url('') . '/storage/articles/' . $mainpath . $imageName;
                $entry->save();
            }
        } else {
            $entry = new Image();
            $name = 'none.png';
            $entry->article_id   = $article->id;
            $entry->url = url('') . '/storage/articles/' . $name;
            $entry->save();
        }
        return back()->with('success', 'تم اضافة المقال بنجاح');
    }
    public function update(Request $request)
    {
        $request->validate([
            'title'             =>  'required',
        ]);
        $id = $request->article_id;
        $article = Article::find($id);
        $article->article_name          = $request->title;
        $article->article_description   = $request->description;
        $article->allow_comment         = $request->allow_comment;
        $article->save();
        $mainpath = date("Y-m-d") . '/';
        $files = $request->file('files');
        if (isset($files)) {
            foreach ($files as $file) {
                $fileNameWithExtension = $file->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $imageName = $fileName . '_' . time() . '.' . $extension;
                $path = $file->move(public_path('storage/articles/' . $mainpath), $imageName);
                $entry = new Image();
                $entry->article_id          = $article->id;
                $entry->filename            = $imageName;
                $entry->url                 = url('') . '/storage/articles/' . $mainpath . $imageName;
                $entry->save();
            }
        } else {
            $entry = new Image();
            $name = 'none.png';
            $entry->article_id   = $article->id;
            $entry->url = url('') . '/storage/articles/' . $name;
            $entry->save();
        }
        return back()->with('success', 'تم تعديل المنشور بنجاح');
    }
    public function destroy(Request $request)
    {
        $article = Article::where('id', $request->article_id)->first();
        if ($article) {
            $images = Image::where('article_id', $request->article_id)->get();
            foreach ($images as $image) {
                if ($image->filename != 'none.png') {
                    $timestamp = strtotime($image->created_at);
                    $date = date('Y-m-d', $timestamp);
                    if (File::exists(public_path('storage/articles/' . $date . '/' . $image->filename))) {
                        File::delete(public_path('storage/articles/' . $date . '/' . $image->filename));
                    } else {
                        return back()->with('faild', "لا يمكنك حذف المقال");
                    }
                }
                $imageMain = Image::where('id', $image->id)->first();
                $imageMain->delete();
            }
            $article->delete();
            return back()->with('success', 'تم حذف المقال بنجاح');
        } else {
            return back()->with('faild', 'المقال غير موجود');
        }
    }
    public function free(Request $request)
    {
        $article = Article::where('id', $request->article_id)->first();
        if ($article) {
            $article->type = 0;
            $article->save();
            return back()->with('success', 'تم تعيين المقال بنجاح');
        } else {
            return back()->with('faild', 'المقال غير موجود');
        }
    }
    public function notfree(Request $request)
    {
        $article = Article::where('id', $request->article_id)->first();
        if ($article) {
            $article->type = 1;
            $article->save();
            return back()->with('success', 'تم الغاء تعيين المقال بنجاح');
        } else {
            return back()->with('faild', 'المقال غير موجود');
        }
    }
    public function deleteImage(Request $request)
    {
        $images = Image::where('article_id', $request->article_id)->get();
        if ($images->count() > 1) {
            $image = Image::where('id', $request->image_id)->first();
            if ($image->filename != 'none.png') {
                $timestamp = strtotime($image->created_at);
                $date = date('Y-m-d', $timestamp);
                if (File::exists(public_path('storage/articles/' . $date . '/' . $image->filename))) {
                    File::delete(public_path('storage/articles/' . $date . '/' . $image->filename));
                } else {
                    return back()->with('faild', "لا يمكنك حذف الصورة");
                }
            }
            $imageMain = Image::where('id', $image->id)->first();
            $imageMain->delete();
            return back()->with('success', 'تم حذف الصورة بنجاح');
        } else {
            return back()->with('faild', 'اخر صورة لا يمكن حذفها');
        }
    }
}
