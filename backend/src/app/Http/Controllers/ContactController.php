<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    // Affiche les contacts
    public function index()
    {
        $user = Auth::user();
        $contacts = Contact::where('user_id', $user->id)->get();

        return view('pages.contacts', compact('contacts'));
    }

    // Enregistre un contact
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'lien' => 'nullable|string|max:255',
            'prioritaire' => 'nullable'
        ]);

        Contact::create([
            'user_id' => auth()->id(),
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'lien' => $request->lien,
            'prioritaire' => $request->boolean('prioritaire')
        ]);

        return redirect(
            $request->redirect_after ?? route('contacts.index')
        )->with('success', 'Contact ajouté');
    }

    // Page édition
    public function edit(Contact $contact)
    {
        $this->authorize('update', $contact); // si tu veux vérifier que c'est bien le user
        return view('pages.edit-contact', compact('contact'));
    }

    // Mise à jour
    public function update(Request $request, Contact $contact)
    {
        $this->authorize('update', $contact);

        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'lien' => 'nullable|string|max:255',
            'prioritaire' => 'nullable'
        ]);

        $contact->update([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'lien' => $request->lien,
            'prioritaire' => $request->boolean('prioritaire')
        ]);

        return redirect()->route('contacts.index')->with('success', 'Contact modifié');
    }

    // Supprimer
    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);
        $this->authorize('update', $contact);

        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact supprimé');
    }



}




