<?php

namespace App\Http\Controllers;

use App\Models\Terms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TermsController extends Controller
{
    public function index()
    {
        $terms = Terms::latest()->paginate(5);
        return view('modules.Terms.Terms',[
            'terms' => $terms
        ]);
    }
        public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'description' => 'required|min:2|string',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add Terms.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $terms = new Terms();
        $terms-> description = $request->description;

        $terms->save();

        flash()->success('Terms added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, Terms $terms)
    {
        $terms = Terms::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'description' => 'required|min:2|string',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update Terms.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $terms-> description = $request->description;

        $terms->save();
        flash()->success('Terms updated successfully.');
        return redirect()->back();
    }
    public function destroy(Request $request, Terms $terms)
    {
        $id = $request->id;
        $terms = Terms::find($id);

        if (!$terms) {
            return response()->json([
                'status' => false,
                'message' => 'Terms not found.',
            ], 404);
        }

        $terms->delete();
        flash()->success('Terms deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Terms deleted successfully.',
        ], 200);
    }
}
