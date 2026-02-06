<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Medication;


class DashboardController extends Controller
{
   public function index()
    {
        // Rappels médicaments
        $medicationReminders = Reminder::where('user_id', auth()->id())
            ->where('type', 'médicament')
            ->where('est_effectue', false)
            ->orderBy('heure')
            ->get();

        // Rappels hydratation
        $hydrationReminders = Reminder::where('user_id', auth()->id())
            ->where('type', 'hydration')
            ->where('est_effectue', false)
            ->orderBy('heure')
            ->get();

        // Contacts urgents
        $contactUrgent = Contact::where('user_id', auth()->id())
            ->orderByDesc('prioritaire')
            ->first();

        // Médicaments
        $medicaments = Medication::where('user_id', auth()->id())->get();

        Reminder::firstOrCreate([
            'user_id' => auth()->id(),
            'type' => 'hydration',
            'heure' => '10:00:00',
        ], [
            'message' => "Boire de l'eau",
            'est_effectue' => false,
            'is_daily' => true,
        ]);


        return view('dashboard.index', [
            'medicationReminders' => $medicationReminders,
            'hydrationReminders' => $hydrationReminders,
            'medicaments'        => $medicaments,
            'contactUrgent'      => $contactUrgent,
        ]);
    }

    public function markDone($id)
    {
        $reminder = Reminder::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $reminder->est_effectue = true;
        $reminder->save();

        return redirect()->back()->with('success', 'Rappel validé');
    }
}

