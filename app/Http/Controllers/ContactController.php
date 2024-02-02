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
        $request->validate([
            'nome' => 'required|min:5',
            'contato' => 'required|digits:9',
            'email' => 'required|email|unique:contacts',
        ]);

        Contact::create($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contato criado com sucesso!');
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'nome' => 'required|min:5',
            'contato' => 'required|digits:9',
            'email' => 'required|email|unique:contacts,email,' . $contact->id,
        ]);

        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contato atualizado com sucesso!');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contato excluído com sucesso!');
    }
}
