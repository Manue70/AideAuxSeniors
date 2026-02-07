<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HydrationController extends Controller
{
    
    public function index()
    {
        
        return view('hydration.index'); 
    }

    // Enregistrement de l'hydratation
    public function store(Request $request)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        Hydration::create([
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
        ]);


        
        return back()->with('success', 'Hydratation enregistrée : '.$request->quantity.' ml');
    }
}
