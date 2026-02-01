<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use App\Notifications\ReminderCreated;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Models\Medication;


class ReminderController extends Controller
{
    

    /**
     * Affiche les rappels du jour pour l'utilisateur connecté
     */
    public function index(Request $request)
    {
        $user = Auth::user();



        // Redirige vers login si utilisateur non connecté
        if (!$user) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à vos rappels.');
        }

        $today = Carbon::today()->toDateString(); // format 'YYYY-MM-DD'

        // Base query pour les rappels du jour ou quotidiens
        $query = Reminder::where('user_id', $user->id)
            ->where(function ($q) use ($today) {
                $q->whereDate('created_at', $today)
                ->orWhere('is_daily', true);
            });

        // Filtrage optionnel (ex : uniquement les tâches "À faire")
        if ($request->input('filter') === 'todo') {
            $query->where('est_effectue', false);
        }

        // Récupération des rappels triés par heure
            $reminders = $query->orderBy('heure')->get()->map(function ($reminder) {
            $reminder->heure = $reminder->heure ?? '08:00'; // valeur par défaut
            $reminder->message = $reminder->message ?? '—';
            $reminder->type = $reminder->type ?? 'autre';
            return $reminder;
        });

         return view('pages.rappels', compact('reminders'));

    }


    /**
     * Ajoute un nouveau rappel
     */
    public function store(Request $request)
    {
        \Log::info('Reminder POST:', $request->all());


        $request->validate([
            'type' => 'required|string|max:50',
            'message' => 'required|string|max:255',
            'heure' => 'required|array',
            'heure.*' => 'required|date_format:H:i',
        
        ]);
        $user = Auth::user();

        foreach ($request->heure as $h) {
             $reminder = Reminder::create([
                'user_id' => $user->id,
                'type' => $request->type,
                'message' => $request->message,
                'heure' => $h,
                'est_effectue' => false,
                'is_daily'     => $request->boolean('is_daily'), 
            ]);

            Notification::send($user, new ReminderCreated($reminder));
        }
    
         $redirect = $request->redirect_after ?? route('rappels');

        return redirect($redirect)->with('success', 'Rappel créé avec succès.');
    }

    /**
     * Bascule l'état "fait / à faire" d'un rappel
     */
    public function toggle(Request $request, $id)
        {
            $user = auth()->user();

            $reminder = Reminder::where('id', $id)
                                ->where('user_id', $user->id)
                                ->firstOrFail();

            $reminder->est_effectue = !$reminder->est_effectue;
            $reminder->save();

            if ($request->from_onboarding) {
                return redirect()->route('onboarding.2')
                                ->with('success', 'Rappel enregistré');
            }

            // Si pas depuis onboarding
            return redirect()->route('rappels')
                            ->with('success', 'Statut du rappel mis à jour.');
        }


    public function clearDone()
    {
        $userId = auth()->id();

        // Supprime les rappels faits
         Reminder::where('user_id', $userId)
            ->where('est_effectue', true)
            ->delete(); 

         return redirect()->back()->with('success', 'Rappels effectués nettoyés !');

    }

    
}
