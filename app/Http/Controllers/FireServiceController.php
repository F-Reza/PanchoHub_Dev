<?php

namespace App\Http\Controllers;

use App\Models\FireService;
use Illuminate\Http\Request;

class FireServiceController extends Controller
{
    public function index()
    {
        $fireServices = FireService::latest()->paginate(25);
        return view('modules.FireService.FireService',[
            'fireServices' => $fireServices
        ]);
    }
    public function store(Request $request)
    {

        $fireService = new FireService();
        $fireService-> title = $request->title;
        $fireService-> contact = $request->contact;
        $fireService-> upazila = $request->upazila;
        $fireService-> address = $request->address;

        $fireService->save();

        flash()->success('Fire Service added successfully.');
        return redirect()->back();
    }
    public function update($id, Request $request, FireService $fireService)
    {
        $fireService = FireService::findOrFail($id);
        $fireService-> title = $request->title;
        $fireService-> contact = $request->contact;
        $fireService-> upazila = $request->upazila;
        $fireService-> address = $request->address;

        $fireService->save();

        flash()->success('Fire Service updated successfully.');
        return redirect()->back();
    }
    public function destroy(Request $request, FireService $fireService)
    {

        $id = $request->id;
        $fireService = FireService::find($id);

        if (!$fireService) {
            return response()->json([
                'status' => false,
                'message' => 'Fire Service not found.',
            ], 404);
        }

        $fireService->delete();
        flash()->success('Fire Service deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Fire Service deleted successfully.',
        ], 200);
    }
}
