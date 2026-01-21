<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller 
{
    public function index(Request $request)
    {
        // Récupère le thème depuis la session ou 'clair' par défaut
        $theme = $request->session()->get('theme', 'clair');

        return view('home', compact('theme'));
    }

    // Action pour changer le thème
    public function switchTheme(Request $request)
    {
        // Récupère le thème actuel et bascule
        $current = $request->session()->get('theme', 'clair');
        $newTheme = $current === 'clair' ? 'bleu' : 'clair';
        $request->session()->put('theme', $newTheme);

        // Redirige vers la page d'accueil
        return redirect()->route('home');
    }
}


