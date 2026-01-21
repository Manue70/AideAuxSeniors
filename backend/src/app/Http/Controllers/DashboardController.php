<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index'); // ou index.blade.php
    }

    public function markDone(Request $request)
    {
        // DEBUG : vérifier si la requête arrive
        // dd($request->all());

        $task = $request->input('task');

        

        // Redirection avec message
        return redirect()->route('dashboard')->with('success', "La tâche '$task' a été enregistrée !");
    }
}
