<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Pages onboarding avec séquence
    public function page1() { return $this->checkCompletedAndRender('onboarding.page1', 1); }
    public function page2() { return $this->checkCompletedAndRender('onboarding.page2', 2); }
    public function page3() { return $this->checkCompletedAndRender('onboarding.page3', 3); }
    public function page4() { return $this->checkCompletedAndRender('onboarding.page4', 4); }
    public function page5() { return $this->checkCompletedAndRender('onboarding.page5', 5); }

    /**
     * Vérifie si l'onboarding est terminé et force la séquence
     */
    private function checkCompletedAndRender($view, $pageNumber)
    {
        $user = Auth::user();

        // Si onboarding déjà terminé → dashboard
        if ($user->onboarding_completed) {
            return redirect()->route('dashboard');
        }

        // Dernière page atteinte en session (ou 0 si aucune)
        $lastPage = session('onboarding_last_page', 0);

        // Empêche de sauter des pages
        if ($pageNumber > $lastPage + 1) {
            return redirect()->route('onboarding.page'.($lastPage + 1));
        }

        // Met à jour la dernière page atteinte
        session(['onboarding_last_page' => $pageNumber]);

        return view($view);
    }

    /**
     * Bouton "Accéder à mon espace" sur page 5
     */
    public function complete(Request $request)
    {
        $user = Auth::user();
        $user->onboarding_completed = true;
        $user->save();

        // Reset session onboarding
        session()->forget('onboarding_last_page');

        return redirect()->route('dashboard')->with('success', 'Votre onboarding est terminé !');
    }
}
