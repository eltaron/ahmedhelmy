<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Live;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LiveController extends Controller
{
    public function index()
    {
        return view('admin.live.index',[
            'lives'=>Live::all(),
            'maincategories'=>Category::where('parent',0)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'parent'      => 'required',
        ]);
        $live = new Live();
        $live->link         = $request->description;
        $live->user_id      = Auth::user()->id;
        $live->category_id  = $request->parent;
        $live->save();
        return back()->with('success','تم اضافة البث بنجاح');
    }

    public function destroy(Request $request)
    {
        $id = $request->live_id;
        $live = Live::find($id);
        if($live){
            $live->delete();
            return back()->with('success','تم حذف البث بنجاح');
        }else{
            return back()->with('faild','يوجد خطأ');
        }
    }
}
