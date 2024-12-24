<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    public function index(){
        $Contact = Contact::all();
        return Inertia::render('Contact', [
            'Contact' => $Contact,
        ]);
    }

    public function GetContact(){
        $Contact = Contact::all();
        return response()->json($Contact);
    }

    public function AddContact(Request $request)
    {
       $Data= $request->validate([
            'name' => 'required',
            'no_telepon' => 'required',
        ]);

        Contact::create($Data);

        return response()->json(['success' => true, 'Data' => $Data], 201);
    }

    public function EditContact(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->only(['name', 'no_telepon']));
        return response()->json(['success' => true, 'contact' => $contact]);
    }

    public function DeleteContact($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json(['success' => true]);
    }
}
