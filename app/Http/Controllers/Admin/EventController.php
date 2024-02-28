<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class EventController extends Controller
{
    public function index()
    {
        return view('admin.event.index', [
            'events' => Event::all(),
            'maincategories' => Category::where('parent', 0)->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             =>  'required',
            'category_id'       =>  'required',
        ]);
        $event = new Event();
        $event->user_id               = Auth::user()->id;
        $event->category_id           = $request->category_id;
        $event->events_name           = $request->name;
        $event->events_description    = $request->description;
        $event->events_time           = $request->time;
        $event->events_date           = $request->date;
        $event->save();
        return back()->with('success', 'تم اضافة المهمة بنجاح');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'             =>  'required',
        ]);
        $id = $request->event_id;
        $event = Event::find($id);
        $event->events_name          = $request->name;
        $event->events_description   = $request->description;
        $event->events_time          = $request->time;
        $event->events_date          = $request->date;
        $event->save();
        return back()->with('success', 'تم تعديل المهمة بنجاح');
    }

    public function destroy(Request $request)
    {
        $event = Event::where('id', $request->event_id)->first();
        if ($event) {
            $event->delete();
            return back()->with('success', 'تم حذف المهمة بنجاح');
        } else {
            return back()->with('faild', 'المهمة غير موجودة');
        }
    }
}
