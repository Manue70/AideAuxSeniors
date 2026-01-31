<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
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
    public function index(){
        // récupère tous les contacts de l'utilisateur connecté
        $contacts = Contact::where('user_id', auth()->id())->get();

        // envoie la variable à la vue
        return view('pages.contacts', compact('contacts'));
    }
}


