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
            'matin'  => 'nullable',
            'midi'   => 'nullable',
            'soir'   => 'nullable',
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
            if  ($request->has($moment)){
                Reminder::create([
                    'user_id'       => $userId,
                    'medication_id'=> $medication->id,   
                    'type'          => 'médicament',
                    'message'       => "Prendre {$medication->nom} ({$medication->dosage})",
                    'heure'         => $heures[$moment],
                    'est_effectue'  => false,
                    'is_daily'      => $request->has('is_daily'),
                                    
                ]);
            }
        }

        $redirect = $request->redirect_after ?? url()->previous();

        return redirect($redirect)->with('success', 'Médicament et rappels ajoutés !');
    }


    
    public function update(Request $request, $id)
    {
        $medicament = Medication::findOrFail($id);

        $request->validate([
            'nom'    => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'matin'  => 'nullable',
            'midi'   => 'nullable',
            'soir'   => 'nullable|',
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
        $medicament = Medication::findOrFail($id);
        $medicament->delete();

    return redirect()->back()->with('success', 'Médicament supprimé !');
}

}
