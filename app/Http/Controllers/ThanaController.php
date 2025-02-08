<?php

namespace App\Http\Controllers;

use App\Models\Thana;
use App\Models\PoliceStation;
use Illuminate\Http\Request;

class ThanaController extends Controller
{
    public function index()
    {
        $polices = PoliceStation::latest()->paginate(25);
        $thanas = Thana::latest()->paginate(25);
        return view('modules.ThanaPolice.ThanaPolice',[
            'thanas' => $thanas,
            'polices' => $polices
        ]);
    }

    public function store(Request $request)
    {

        $thana = new Thana();
        $thana-> title = $request->title;
        $thana-> contact = $request->contact?? null;
        $thana-> upazila = $request->upazila;
        $thana-> address = $request->address;

        $thana->save();

        flash()->success('Thana added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, Thana $thana)
    {
        $thana = Thana::findOrFail($id);
        $thana-> title = $request->title;
        $thana-> contact = $request->contact?? null;
        $thana-> upazila = $request->upazila;
        $thana-> address = $request->address;

        $thana->save();

        flash()->success('Thana updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, Thana $thana)
    {
        $id = $request->id;
        $thana = Thana::find($id);

        if (!$thana) {
            return response()->json([
                'status' => false,
                'message' => 'Thana not found.',
            ], 404);
        }

        $thana->delete();
        flash()->success('Thana deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Thana deleted successfully.',
        ], 200);
    }
}
