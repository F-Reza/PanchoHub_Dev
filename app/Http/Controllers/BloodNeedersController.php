<?php

namespace App\Http\Controllers;

use App\Models\BloodNeeders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BloodNeedersController extends Controller
{    public function index()
    {
        $needers = BloodNeeders::latest()->paginate(25);
        return view('modules.BloodNeeders.BloodNeederList',[
            'needers' => $needers
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:4',
            'blood_gorup' => 'required',
            'bag_amounts' => 'required',
            'dateline' => 'required',
            'contact' => 'required|regex:/^[0-9]+$/',
            'gender' => 'required|not_in:null,',
            'upazila' => 'required|not_in:null,',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new blood needer.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $needer = new BloodNeeders();
        $needer-> user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $needer-> name = $request->name;
        $needer-> blood_gorup = $request->blood_gorup;
        $needer-> bag_amounts = $request->bag_amounts;
        $needer-> dateline = $request->dateline;
        $needer-> contact = $request->contact;
        $needer-> gender = $request->gender;
        $needer-> upazila = $request->upazila;
        $needer-> hp_address = $request->hp_address?? null;
        $needer-> details = $request->details?? null;
        $needer-> gift = $request->gift?? null;

        $needer->save();

        flash()->success('New blood needer added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, BloodNeeders $bloodNeeders)
    {
        $needer = BloodNeeders::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:4',
            'blood_gorup' => 'required',
            'bag_amounts' => 'required',
            'dateline' => 'required',
            'contact' => 'required|regex:/^[0-9]+$/',
            'gender' => 'required|not_in:null,',
            'upazila' => 'required|not_in:null,',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update blood needer.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $needer-> name = $request->name;
        $needer-> blood_gorup = $request->blood_gorup;
        $needer-> bag_amounts = $request->bag_amounts;
        $needer-> dateline = $request->dateline;
        $needer-> contact = $request->contact;
        $needer-> gender = $request->gender;
        $needer-> upazila = $request->upazila;
        $needer-> hp_address = $request->hp_address?? null;
        $needer-> details = $request->details?? null;
        $needer-> gift = $request->gift?? null;
        $needer->status = $request->status;

        $needer->save();

        flash()->success(' Blood Needer updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, BloodNeeders $bloodNeeders)
    {
        $id = $request->id;
        $needer = BloodNeeders::find($id);

        if (!$needer) {
            return response()->json([
                'status' => false,
                'message' => 'Blood Needer  not found.',
            ], 404);
        }

        $needer->delete();
        flash()->success('Blood Needer deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Blood Needer deleted successfully.',
        ], 200);
    }
}
