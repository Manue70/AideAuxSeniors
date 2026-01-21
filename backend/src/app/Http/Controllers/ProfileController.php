<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Affiche la page paramètres/profil
    public function edit()
    {
        return view('pages.parametres');
    }

    /**
     * Mise à jour du profil utilisateur
     */
    public function update(Request $request)
    {
        $request->validate([
            'prenom'    => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email'     => 'required|email|max:255',
        ]);

        $user = auth()->user();

        // Mise à jour email (table users)
        $user->email = $request->email;
        $user->save();

        // Mise à jour ou création du profil (table profiles)
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'prenom'    => $request->prenom,
                'telephone' => $request->telephone,
            ]
        );

        return back()->with('success', 'Profil mis à jour avec succès');
    }

    /**
     * Supprimer le compte et le profil
     */
    public function destroy()
    {
        $user = Auth::user();

        // Supprimer le profil associé si existant
        if ($user->profile) {
            $user->profile->delete();
        }

        // Supprimer le compte utilisateur
        $user->delete();

        // Déconnexion
        Auth::logout();

        // Redirection vers page home
        return redirect('/')->with('success', 'Votre compte a été supprimé.');
    }
}


