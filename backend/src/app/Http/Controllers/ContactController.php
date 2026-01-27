<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Valider les contacts
        $data = $request->validate([
            'nom' => 'required|array|min:1',
            'nom.*' => 'required|string|max:255',
            'telephone' => 'required|array|min:1',
            'telephone.*' => 'required|string|max:20',
        ]);

        $noms = $data['nom'];
        $telephones = $data['telephone'];

        foreach ($noms as $index => $nom) {
            Contact::create([
                'nom' => $nom,
                'telephone' => $telephones[$index] ?? '',
                'user_id' => auth()->id(),
            ]);
        }

        return redirect()->route('contacts')->with('success', 'Contacts enregistrés !');
    }
}
