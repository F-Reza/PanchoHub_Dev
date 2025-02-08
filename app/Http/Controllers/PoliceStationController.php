<?php

namespace App\Http\Controllers;

use App\Models\PoliceStation;
use Illuminate\Http\Request;

class PoliceStationController extends Controller
{
    // public function index()
    // {
    //     $policeStations = PoliceStation::latest()->paginate(25);
    //     return view('modules.PoliceStation.PoliceStation',[
    //         'policeStations' => $policeStations
    //     ]);
    // }
    public function store(Request $request)
    {

        $policeStation = new PoliceStation();
        $policeStation-> title = $request->title;
        $policeStation-> name = $request->name;
        $policeStation-> contact = $request->contact;
        $policeStation-> upazila = $request->upazila;
        $policeStation-> address = $request->address;

        $policeStation->save();

        flash()->success('PoliceStation added successfully.');
        return redirect()->back();
    }
    public function update($id, Request $request, PoliceStation $policeStation)
    {
        $policeStation = PoliceStation::findOrFail($id);
        $policeStation-> title = $request->title;
        $policeStation-> name = $request->name;
        $policeStation-> contact = $request->contact;
        $policeStation-> upazila = $request->upazila;
        $policeStation-> address = $request->address;

        $policeStation->save();

        flash()->success('PoliceStation updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, PoliceStation $policeStation)
    {
        $id = $request->id;
        $policeStation = PoliceStation::find($id);

        if (!$policeStation) {
            return response()->json([
                'status' => false,
                'message' => 'PoliceStation not found.',
            ], 404);
        }

        $policeStation->delete();
        flash()->success('PoliceStation deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'PoliceStation deleted successfully.',
        ], 200);
    }
}
