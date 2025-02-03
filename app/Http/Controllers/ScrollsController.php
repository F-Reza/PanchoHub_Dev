<?php

namespace App\Http\Controllers;

use App\Models\Scrolls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ScrollsController extends Controller
{
    public function index()
    {
        $scrolls = Scrolls::with('user')->latest()->paginate(25);
        return view('modules.Scrolls.ScrollList',[
            'scrolls' => $scrolls
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'category' => 'required|not_in:null,',
            'text' => 'required|min:4|string',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to add new scroll.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $scroll = new Scrolls();
        $scroll->user_id = Auth::user()->id;
        $scroll-> category = $request->category;
        $scroll-> text = $request->text;

        $scroll->save();

        flash()->success('Scroll added successfully.');
        return redirect()->back();
    }

    public function update($id, Request $request, Scrolls $scrolls)
    {
        $scroll = Scrolls::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'category' => 'required|not_in:null,',
            'text' => 'required|min:4|string',
        ]);

        if ($validator->fails()) {
            flash()->error('Failed to update scroll.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $scroll-> category = $request->category;
        $scroll-> text = $request->text;
        $scroll->status = $request->status ? 'Active' : 'Deactive';

        $scroll->save();

        flash()->success('Scroll updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, Scrolls $scrolls)
    {
        $id = $request->id;
        $scroll = Scrolls::find($id);

        if (!$scroll) {
            return response()->json([
                'status' => false,
                'message' => 'Scroll not found.',
            ], 404);
        }

        $scroll->delete();
        flash()->success('Scroll deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Scroll deleted successfully.',
        ], 200);
    }
}
