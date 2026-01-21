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
            'users' => User::latest()->take(5)->get(),
        ]);
    }
}
