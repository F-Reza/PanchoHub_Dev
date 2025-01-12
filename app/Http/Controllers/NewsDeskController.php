<?php

namespace App\Http\Controllers;

use App\Models\NewsDesk;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;


class NewsDeskController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
       return [
        new Middleware('permission:Post View', only: ['index']),
        new Middleware('permission:Post Edit', only: ['edit']),
        new Middleware('permission:Post Create', only: ['create']),
        new Middleware('permission:Post Delete', only: ['destroy']),
       ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news_desks = NewsDesk::latest()->paginate(25);
        return view('modules.news_desks.list',[
            'news_desks' => $news_desks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.news_desks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:5'
        ]);

        if ($validator->passes()) {
            $news_desks = new NewsDesk();
            $news_desks-> title = $request->title;
            $news_desks-> discription = $request->discription;
            $news_desks->save();

            return redirect()->route('news_desks.index')->with('success', 'News added successfully.');
        } else {
            return redirect()->route('news_desks.create')->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsDesk $newsDesk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsDesk $newsDesk, $id)
    {
        $news_desks = NewsDesk::findOrFail($id);
        return view('modules.news_desks.edit',[
            'news_desks' => $news_desks
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NewsDesk $newsDesk, $id)
    {
        $news_desks = NewsDesk::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'title' => 'required|min:5',
        ]);

        if ($validator->passes()) {
            $news_desks-> title = $request->title;
            $news_desks-> discription = $request->discription;
            $news_desks->save();

            return redirect()->route('news_desks.index')->with('success', 'News updated successfully.');
        } else {
            return redirect()->route('news_desks.edit',$id)->withInput()->withErrors($validator);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, NewsDesk $newsDesk)
    {
        $id = $request->id;
        $news_desks = NewsDesk::find($id);

        if (!$news_desks) {
            return response()->json([
                'status' => false,
                'message' => 'News not found.',
            ], 404);
        }

        $news_desks->delete();

        return response()->json([
            'status' => true,
            'message' => 'News deleted successfully.',
        ], 200);
    }
}
