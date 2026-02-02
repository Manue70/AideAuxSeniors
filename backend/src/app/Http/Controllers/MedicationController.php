<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medication;
use App\Models\Reminder;

class MedicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom'    => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'matin'  => 'nullable|in:oui,non',
            'midi'   => 'nullable|in:oui,non',
            'soir'   => 'nullable|in:oui,non',
            'is_daily'=> 'nullable',
        ]);

        $userId = auth()->id();

        // Créer le médicament
        $medication = Medication::create([
            'user_id' => $userId,
            'nom'     => $request->nom,
            'dosage'  => $request->dosage,
            'is_daily' => $request->has('is_daily'),
        ]);

        // Créer les rappels
        $heures = [
            'matin' => '08:00:00',
            'midi'  => '12:00:00',
            'soir'  => '19:00:00',
        ];

        foreach (['matin','midi','soir'] as $moment) {
            if ($request->input($moment) === 'oui') {
                Reminder::create([
                    'user_id'      => $userId,
                    'type'         => 'médicament',
                    'message'      => "Prendre {$medication->nom} ({$medication->dosage})",
                    'heure'        => $heures[$moment],
                    'est_effectue' => false,
                    'is_daily'     => $request->has('is_daily'),
                ]);
            }
        }

        $redirect = $request->redirect_after ?? url()->previous();

        return redirect($redirect)->with('success', 'Médicament et rappels ajoutés !');
    }


    
    public function update(Request $request, Medication $medicament)
    {
        $request->validate([
            'nom'    => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'matin'  => 'nullable|in:oui,non',
            'midi'   => 'nullable|in:oui,non',
            'soir'   => 'nullable|in:oui,non',
            'is_daily'=> 'nullable',
        ]);

        // Supprimer les anciens rappels
        Reminder::where('user_id', auth()->id())
            ->where('type', 'médicament')
            ->where('message', 'like', "%{$medicament->nom}%")
            ->delete();


        $medicament->update([
            'nom' => $request->nom,
            'dosage' => $request->dosage,
            'is_daily' => $request->has('is_daily'),


            
        ]);


        return redirect()->back()->with('success', 'Médicament mis à jour !');
    }

    public function destroy(Medication $medicament)
    {
        $medicament->delete();
        return redirect()->back()->with('success', 'Médicament supprimé !');
    }

}
