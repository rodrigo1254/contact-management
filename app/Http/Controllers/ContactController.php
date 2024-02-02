<?php

namespace App\Http\Controllers;
use App\Models\Contact;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'nome' => 'required|min:5',
                'contato' => 'required|digits:9|unique:contacts',
                'email' => 'required|email|unique:contacts',
            ]);
            $contact = Contact::create($request->all());
            return response()->json(['status' => true, 'users' => $contact],200);
        }catch (\Exception $e){
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        
        return redirect()->route('contacts.index')->with('success', 'Contato criado com sucesso!');
    }

    public function show($id)
    {
        try{
            $contact = Contact::findOrFail($id);
            return response()->json(['status' => true, 'contact' => $contact],200);
        }catch (\Exception $e){
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        try{
            $request->validate([
                'nome' => 'required|min:5',
                'contato' => 'required|digits:9',
                'email' => 'required|email|unique:contacts,email,' . $contact->id,
            ]);
            $data = $contact->update($request->all());

            return response()->json(['status' => true, 'contact' => $data],200);
        }catch (\Exception $e){
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Contact $contact)
    {
        try{
            $contact->delete();
            return response()->json(['status' => true],200);
        }catch (\Exception $e){
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
