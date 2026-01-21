<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medication;
use App\Models\Reminder;

class MedicationController extends Controller
{
    // Ajouter un médicament et créer les rappels correspondants
    public function store(Request $request)
    {
        $request->validate([
            'nom'  => 'required|string|max:255',
            'dose' => 'required|string|max:255',
            'matin' => 'nullable|in:oui,non',
            'midi'  => 'nullable|in:oui,non',
            'soir'  => 'nullable|in:oui,non',
        ]);

        // Créer le médicament
        $medication = Medication::create([
            'user_id' => auth()->id(),
            'nom'     => $request->nom,
            'dosage'  => $request->dose,
        ]);

        // Créer les rappels automatiquement
        $heures = [
            'matin' => '08:00:00',
            'midi'  => '12:00:00',
            'soir'  => '19:00:00',
        ];

        foreach (['matin', 'midi', 'soir'] as $moment) {
            if ($request->input($moment) === 'oui') {
                Reminder::create([
                    'user_id'      => auth()->id(),
                    'type'         => 'médicament',
                    'message'      => "Prendre {$medication->nom} ({$medication->dosage})",
                    'heure'        => $heures[$moment],
                    'est_effectue' => false,
                ]);
            }
        }

        return redirect()->route('onboarding.3')
            ->with('success', 'Médicament et rappels ajoutés !');
    }
}
