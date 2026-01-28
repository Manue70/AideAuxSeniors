<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin', [
            'usersCount' => User::count(),
            'adminsCount' => User::where('is_admin', 1)->count(),
            'users' => User::withCount('reminders')
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
    public function destroy(User $user)
    {

        if (auth()->id() === $user->id) {
        return redirect()->route('admin')->with('error', 'Vous ne pouvez pas supprimer votre propre compte admin.');
        }

        $user->delete();

        return redirect()->route('admin')->with('success', 'Utilisateur supprimé.');
    }
}



