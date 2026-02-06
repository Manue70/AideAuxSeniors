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
        // Médicaments
        $medicationReminders = Reminder::where('user_id', auth()->id())
            ->where('type', 'médicament')
            ->where('est_effectue', false)
            ->orderBy('heure')
            ->get();

        // Hydratation
        $hydrationReminders = Reminder::where('user_id', auth()->id())
            ->where('type', 'hydration')
            ->where('est_effectue', false)
            ->orderBy('heure')
            ->get();

        // Autres rappels (sport, réveil, rdv...)
        $otherReminders = Reminder::where('user_id', auth()->id())
            ->whereNotIn('type', ['médicament', 'hydration'])
            ->where('est_effectue', false)
            ->orderBy('heure')
            ->get();

        $contactUrgent = Contact::where('user_id', auth()->id())
            ->orderByDesc('prioritaire')
            ->first();

        $medicaments = Medication::where('user_id', auth()->id())->get();

        // Tri par moment de la journée
        $otherRemindersByMoment = $this->groupByMoment($otherReminders);

        return view('dashboard.index', [
            'medicationReminders'       => $medicationReminders,
            'hydrationReminders'        => $hydrationReminders,
            'otherRemindersGrouped'            => $otherRemindersByMoment,
            'medicaments'               => $medicaments,
            'contactUrgent'             => $contactUrgent,
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

    // Méthode privée pour trier les rappels par moment de la journée
    private function groupByMoment($reminders)
    {
        $groups = [
            'Matin' => [],
            'Midi'  => [],
            'Soir'  => [],
        ];

        foreach ($reminders as $reminder) {
            $heure = intval(explode(':', $reminder->heure)[0]); // récupère l'heure
            if ($heure >= 5 && $heure < 12) {
                $groups['Matin'][] = $reminder;
            } elseif ($heure >= 12 && $heure < 18) {
                $groups['Midi'][] = $reminder;
            } else {
                $groups['Soir'][] = $reminder;
            }
        }

        return $groups;
    }
}
