<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfidentialiteController extends Controller
{
    // Supprimer le compte
    public function destroy(Request $request)
    {
        $user = $request->user();
        $user->delete();

        return response()->json([
            'message' => 'Compte supprimé avec succès'
    ]); 
    }
}
