<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Audio;
use App\Models\Category;
use App\Models\Exam;
use App\Models\Live;
use App\Models\Quote;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->status == 1) {
            $audios = Audio::where('status', 1)->whereIn('category_id', [Auth::user()->groupid, Auth::user()->category->parent])->orderBy('id', 'DESC')->get();
            $quotes = Quote::whereIn('category_id', [Auth::user()->groupid, Auth::user()->category->parent])->orderBy('id', 'DESC')->get();
            $lives = Live::whereIn('category_id', [Auth::user()->groupid, Auth::user()->category->parent])->orderBy('id', 'DESC')->get();
            $fullExams = Exam::where('type', '!=', 0)->whereIn('category_id', [Auth::user()->groupid, Auth::user()->category->parent])->orderBy('id', 'DESC')->get();
            $categories = Category::where('parent', Auth::user()->groupid)->get();
            return view('web.dashboard.index', [
                'audios' => $audios,
                'lives' => $lives,
                'fullExams' => $fullExams,
                'categories' => $categories,
                'quotes' => $quotes
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
}
