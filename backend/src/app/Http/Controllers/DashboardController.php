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
        $reminders = Reminder::where('user_id', auth()->id())

            ->where('est_effectue', false)
            ->orderBy('heure')
            ->get();

        $contactUrgent = Contact::where('user_id', auth()->id())
            ->orderByDesc('prioritaire')
            ->first();

        $medicaments = Medication::where('user_id', auth()->id())->get();

        return view('dashboard.index', [
            'reminders'     => $reminders,
            'medicaments'   => $medicaments,
            'contactUrgent' => $contactUrgent,
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

