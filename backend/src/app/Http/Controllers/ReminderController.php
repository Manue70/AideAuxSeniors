<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Medication;


class ReminderController extends Controller
{
    /**
     * Affiche les rappels du jour pour l'utilisateur connecté
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $today = Carbon::today()->toDateString(); // format 'YYYY-MM-DD'

        // Base query pour les rappels du jour de l'utilisateur
        $query = Reminder::where('user_id', $userId)
            ->whereDate('created_at', $today);

        // Filtrage optionnel (ex : uniquement les tâches "À faire")
        if ($request->input('filter') === 'todo') {
            $query->where('est_effectue', false);
        }

        // Récupération des rappels triés par heure
        $reminders = $query->orderBy('heure')->get();

        return view('pages.reminder', compact('reminders'));
    }

    /**
     * Ajoute un nouveau rappel
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:50',
            'message' => 'required|string|max:255',
            'heure' => 'required|array',
            'heure.*' => 'required|date_format:H:i',
        ]);
        foreach ($request->heure as $h) {
            Reminder::create([
                'user_id' => Auth::id(),
                'type' => $request->type,
                'message' => $request->message,
                'heure' => $h,
                'est_effectue' => false,
            ]);
        }
        

    return redirect()->back()->with('success', 'Rappel(s) ajouté(s) avec succès.');
    }

    /**
     * Bascule l'état "fait / à faire" d'un rappel
     */
    public function toggle($id)
    {
        $reminder = Reminder::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $reminder->est_effectue = !$reminder->est_effectue;
        $reminder->save();

        return redirect()->back()->with('success', 'Statut du rappel mis à jour.');
    }
}
