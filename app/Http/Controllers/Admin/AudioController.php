<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Audio;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class AudioController extends Controller
{
    public function index()
    {
        return view('admin.audios.index', [
            'maincategories' => Category::where('parent', 0)->get(),
            'audios' => Audio::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             =>  'required',
            'category_id'       =>  'required',
            'audio'            =>  'required',
        ]);
        $audio = new Audio();
        $audio->user_id               = Auth::user()->id;
        $audio->category_id           = $request->category_id;
        $audio->audio_name            = $request->title;
        $audio->description           = $request->description;
        $audio->status                  = 1;

        $mainpath = date("Y-m-d") . '/';
        $audios = $request->file('audio');
        if (isset($audios)) {
            $fileNameWithExtension = $audios->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $audios->getClientOriginalExtension();
            $imageName = $fileName . '_' . time() . '.' . $extension;
            $path = $audios->move(public_path('storage/audios/' . $mainpath), $imageName);
            $audio->filename         = $imageName;
            $audio->url              = url('') . '/storage/audios/' . $mainpath . $imageName;
        }
        $audio->save();
        return back()->with('success', 'تم اضافة الملف الصوتي بنجاح');
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'             =>  'required',
        ]);
        $audio = Audio::find($request->audio_id);
        $audio->audio_name            = $request->title;
        $audio->description           = $request->description;
        $audio->save();
        return back()->with('success', 'تم تعديل الملف الصوتي بنجاح');
    }

    public function destroy(Request $request)
    {
        $id = $request->audio_id;
        $audio = Audio::find($id);
        if($audio){
            $timestamp = strtotime($audio->created_at);
            $date = date('Y-m-d', $timestamp);
            if(File::exists(public_path('storage/audios/'.$date.'/'.$audio->filename))){
                File::delete(public_path('storage/audios/'.$date.'/'.$audio->filename));
            }
            $audio->delete();
            return back()->with('success','تم حذف الملف الصوتى بنجاح');
        }else{
            return back()->with('faild','يوجد خطأ');
        }
    }
    public function activate(Request $request)
    {
        $id = $request->audio_id;
        $audio = Audio::find($id);
        if($audio){
            $audio->status=1;
            $audio->save();
            return back()->with('success','تم تفعيل الملف الصوتى بنجاح');
        }else{
            return back()->with('faild','يوجد خطأ');
        }
    }
    public function notactivate(Request $request)
    {
        $id = $request->audio_id;
        $audio = Audio::find($id);
        if($audio){
            $audio->status=0;
            $audio->save();
            return back()->with('success','تم الغاء تفعيل الملف الصوتى بنجاح');
        }else{
            return back()->with('faild','يوجد خطأ');
        }
    }
}
