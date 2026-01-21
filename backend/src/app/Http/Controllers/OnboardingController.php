<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    public function page3()
    {
        return view('onboarding.page3'); // correspond à resources/views/onboarding/page3.blade.php
    }
}
