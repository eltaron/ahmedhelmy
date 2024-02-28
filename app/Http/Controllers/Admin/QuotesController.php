<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class QuotesController extends Controller
{
    public function index()
    {
        return view('admin.quotes.index', [
            'quotes' => Quote::all(),
            'maincategories' => Category::where('parent', 0)->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'description'      =>  'required',
        ]);
        $quote = new Quote();
        $quote->description           = $request->description;
        $quote->category_id           = $request->category_id;
        $mainpath = date("Y-m-d") . '/';
        $file = $request->file('file');
        if ($file) {
            $fileNameWithExtension = $file->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $imageName = $fileName . '_' . time() . '.' . $extension;
            $path = $file->move(public_path('storage/books/' . $mainpath), $imageName);
            $quote->image           = url('') . '/storage/books/' . $mainpath . $imageName;
            $quote->filename        = $imageName;
        }
        $quote->save();
        return back()->with('success', 'تم الاضافة بنجاح');
    }

    public function destroy(Request $request)
    {
        $id = $request->quote_id;
        $quote = Quote::find($id);
        if ($quote) {
            $timestamp = strtotime($quote->created_at);
            $date = date('Y-m-d', $timestamp);
            if ($quote->image) {
                if (File::exists(public_path('storage/books/' . $date . '/' . $quote->filename))) {
                    File::delete(public_path('storage/books/' . $date . '/' . $quote->filename));
                } else {
                    return back()->with('faild', "حدث خطأ في الحذف ");
                }
            }
            $quote->delete();
            return back()->with('success', 'تم الحذف بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }
}
