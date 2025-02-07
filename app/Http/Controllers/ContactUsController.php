<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $contacts = ContactUs::latest()->paginate(25);
        return view('modules.ContactUs.ContactUs',[
            'contacts' => $contacts
        ]);
    }
    public function store(Request $request)
    {
        $user = new ContactUs();
        $user-> email = $request->email;
        $user-> phone = $request->phone;
        $user-> address = $request->address;
        $user-> about = $request->about;
        $user-> services = $request->services;
        $user-> fb_page = $request->fb_page;
        $user-> fb_group = $request->fb_group;
        $user-> youtube = $request->youtube;

        $user->save();

        flash()->success('ContactUs added successfully.');
        return redirect()->back();
    }
    public function update($id, Request $request, ContactUs $contactUs)
    {
        $user = ContactUs::findOrFail($id);

        $user-> email = $request->email;
        $user-> phone = $request->phone;
        $user-> address = $request->address;
        $user-> about = $request->about;
        $user-> services = $request->services;
        $user-> fb_page = $request->fb_page;
        $user-> fb_group = $request->fb_group;
        $user-> youtube = $request->youtube;

        $user->save();
        flash()->success('ContactUs updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, ContactUs $contactUs)
    {
        $id = $request->id;
        $contact = ContactUs::find($id);

        if (!$contact) {
            return response()->json([
                'status' => false,
                'message' => 'ContactUs not found.',
            ], 404);
        }

        $contact->delete();

        return response()->json([
            'status' => true,
            'message' => 'ContactUs deleted successfully.',
        ], 200);
    }
}
