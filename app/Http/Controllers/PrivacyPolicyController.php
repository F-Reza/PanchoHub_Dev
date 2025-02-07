<?php

namespace App\Http\Controllers;

use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $privaces= PrivacyPolicy::latest()->paginate(5);
        return view('modules.Privacy.Privacy',[
            'privaces' => $privaces
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'description' => 'required|min:2|string',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add Privacy.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $privacy = new PrivacyPolicy();
        $privacy-> description = $request->description;

        $privacy->save();

        flash()->success('Privacy added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, PrivacyPolicy $privacyPolicy)
    {
        $privacy = PrivacyPolicy::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'description' => 'required|min:2|string',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update Privacy.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $privacy-> description = $request->description;

        $privacy->save();
        flash()->success('Privacy updated successfully.');
        return redirect()->back();
    }
    public function destroy(Request $request, PrivacyPolicy $privacyPolicy)
    {
        $id = $request->id;
        $privacy = PrivacyPolicy::find($id);

        if (!$privacy) {
            return response()->json([
                'status' => false,
                'message' => 'Privacy not found.',
            ], 404);
        }

        $privacy->delete();
        flash()->success('Privacy deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Privacy deleted successfully.',
        ], 200);
    }
}
