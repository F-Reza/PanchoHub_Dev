<?php

namespace App\Http\Controllers;

use App\Models\BloodDonors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BloodDonorsController extends Controller
{
    public function index()
    {
        $donors = BloodDonors::with('user')->latest()->paginate(25);
        return view('modules.BloodDonors.BloodDonorList',[
            'donors' => $donors
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:4',
            'blood_gorup' => 'required',
            'last_donate' => 'required',
            'contact' => 'required|regex:/^[0-9]+$/',
            'gender' => 'required|not_in:null,',
            'upazila' => 'required|not_in:null,',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new blood donor.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $donor = new BloodDonors();
        $donor-> user_id = Auth::user()->id;
        $donor-> name = $request->name;
        $donor-> blood_gorup = $request->blood_gorup;
        $donor-> last_donate = $request->last_donate;
        $donor-> contact = $request->contact;
        $donor-> gender = $request->gender;
        $donor-> upazila = $request->upazila;
        $donor-> address = $request->address?? null;
        $donor-> comment = $request->comment?? null;

        $donor->save();

        flash()->success('New blood donor added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, BloodDonors $bloodDonors)
    {
        $donor = BloodDonors::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:4',
            'blood_gorup' => 'required',
            'last_donate' => 'required',
            'contact' => 'required|regex:/^[0-9]+$/',
            'gender' => 'required|not_in:null,',
            'upazila' => 'required|not_in:null,',
            'status' => 'required|not_in:null,',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update blood donor.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $donor-> name = $request->name;
        $donor-> blood_gorup = $request->blood_gorup;
        $donor-> last_donate = $request->last_donate;
        $donor-> contact = $request->contact;
        $donor-> gender = $request->gender;
        $donor-> upazila = $request->upazila;
        $donor-> address = $request->address?? null;
        $donor-> comment = $request->comment?? null;
        $donor->status = $request->status;

        $donor->save();

        flash()->success('Blood Donor updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, BloodDonors $bloodDonors)
    {
        $id = $request->id;
        $donor = BloodDonors::find($id);

        if (!$donor) {
            return response()->json([
                'status' => false,
                'message' => 'Blood Donor  not found.',
            ], 404);
        }

        $donor->delete();
        flash()->success('Blood Donor deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Blood Donor deleted successfully.',
        ], 200);
    }
}
