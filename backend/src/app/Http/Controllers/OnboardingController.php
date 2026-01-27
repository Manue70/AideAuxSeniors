<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    public function __construct()
    {
        // Toutes les pages onboarding nécessitent que l'utilisateur soit connecté
        $this->middleware('auth');
    }

    // Exemple pour toutes les pages, ici page 1
    public function page1()
    {
        return $this->checkCompletedAndRender('onboarding.page1');
    }

    public function page2()
    {
        return $this->checkCompletedAndRender('onboarding.page2');
    }

    public function page3()
    {
        return $this->checkCompletedAndRender('onboarding.page3');
    }

    public function page4()
    {
        return $this->checkCompletedAndRender('onboarding.page4');
    }

    public function page5()
    {
        return $this->checkCompletedAndRender('onboarding.page5');
    }

    /**
     * Vérifie si l'onboarding est déjà complété.
     * Si oui → redirection vers le dashboard.
     * Sinon → retourne la vue demandée.
     */
    private function checkCompletedAndRender($view)
    {
        $user = Auth::user();

        if ($user->onboarding_completed) {
            return redirect()->route('dashboard');
        }

        return view($view);
    }

    /**
     * Action du bouton "Accéder à mon espace" sur la page 5
     */
    public function complete(Request $request)
    {
        $user = Auth::user();
        $user->onboarding_completed = true;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Votre onboarding est terminé !');
    }
}
