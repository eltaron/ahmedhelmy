<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class CategoryController extends Controller
{

    public function index()
    {
        return view('admin.category.index', [
            'categories'    => Category::all(),
            'maincategories' => Category::where('parent', 0)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required'
        ]);
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_description = $request->description;
        $category->parent = $request->parent;
        $category->user_id = Auth::user()->id;
        $mainpath = date("Y-m-d") . '/';
        $file = $request->file('file');
        if ($file) {
            $fileNameWithExtension = $file->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $imageName = $fileName . '_' . time() . '.' . $extension;
            $path = $file->move(public_path('storage/categories/' . $mainpath), $imageName);
            $category->image           = url('') . '/storage/categories/' . $mainpath . $imageName;
        }
        $category->save();
        return back()->with('success', 'تم اضافة القسم بنجاح');
    }

    public function show($id)
    {
        return view('admin.category.show', ['category' => Category::find($id)]);
    }

    public function update(Request $request)
    {
        $id          = $request->cat_id;
        $name        = $request->name;
        $description = $request->description;
        $category = Category::where('id', $id)->first();
        if ($category) {
            $category->category_name        = $name;
            $category->category_description = $description;
            $mainpath = date("Y-m-d") . '/';
            $file = $request->file('file');
            if ($file) {
                $fileNameWithExtension = $file->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $imageName = $fileName . '_' . time() . '.' . $extension;
                $path = $file->move(public_path('storage/categories/' . $mainpath), $imageName);
                $category->image           = url('') . '/storage/categories/' . $mainpath . $imageName;
            }
            $category->save();
            return back()->with('success', 'تم تعديل القسم بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->cat_id;
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return back()->with('success', 'تم حذف القسم بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }
    public function activate(Request $request)
    {
        $id = $request->cat_id;
        $category = Category::where('id', $id)->first();
        if ($category) {
            $category->Visibility = 1;
            $category->save();
            return back()->with('success', 'تم تفعيل القسم بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }
    public function not_activate(Request $request)
    {
        $id = $request->cat_id;
        $category = Category::where('id', $id)->first();
        if ($category) {
            $category->Visibility = 0;
            $category->save();
            return back()->with('success', 'تم الغاء تفعيل القسم بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }
}
