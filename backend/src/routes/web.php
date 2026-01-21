<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\AssistantController;
use App\Http\Controllers\ConfidentialiteController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Pages publiques
|--------------------------------------------------------------------------
*/
Route::get('/test-db', function() {
    try {
        \DB::connection()->getPdo();
        return 'DB OK';
    } catch (\Exception $e) {
        return 'DB ERROR: ' . $e->getMessage();
    }
});



// Accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Thème
Route::get('/theme-toggle', function (Request $request) {
    $current = session('theme', 'clair');
    session(['theme' => $current === 'clair' ? 'bleu' : 'clair']);
    return back();
})->name('switch-theme');

/*
|--------------------------------------------------------------------------
| Authentification
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Register
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

/*
|--------------------------------------------------------------------------
| Zone protégée : utilisateurs connectés
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/mark-done', [DashboardController::class, 'markDone'])->name('dashboard.markDone');


    // Création d’un médicament (POST)
    Route::post('/medicaments', [MedicationController::class, 'store'])
        ->name('medicaments.store');

    Route::delete('/medicaments/{medicament}', [MedicationController::class, 'destroy'])
        ->name('medicaments.destroy');


    // Rappels
    Route::get('/rappels', [ReminderController::class, 'index'])->name('rappels');
    Route::post('/rappels', [ReminderController::class, 'store'])->name('rappels.store');
    Route::post('/rappels/{id}/toggle', [ReminderController::class, 'toggle'])->name('rappels.toggle');

    // Onboarding
    Route::prefix('onboarding')->group(function () {
        Route::get('/1', fn() => view('onboarding.page1'))->name('onboarding.1');
        Route::get('/2', fn() => view('onboarding.page2'))->name('onboarding.2');
        Route::get('/3', fn() => view('onboarding.page3'))->name('onboarding.3');
        Route::get('/4', fn() => view('onboarding.page4'))->name('onboarding.4');
        Route::get('/5', fn() => view('onboarding.page5'))->name('onboarding.5');
        Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');


        Route::post('/complete', function(Request $request) {
            $user = Auth::user();
            $user->onboarding_completed = true;
            $user->save(); // Obligatoire pour enregistrer dans la DB
            return redirect()->route('dashboard');
        })->name('onboarding.complete');
    });

    // Pages protégées supplémentaires
    Route::get('/contacts', fn() => view('pages.contacts'))->name('contacts');
    Route::get('/assistance', fn() => view('pages.assistance'))->name('assistance');
    Route::get('/assistant', fn() => redirect()->route('assistance'));
    Route::post('/assistant', [AssistantController::class, 'ask']) ->name('assistant') ->middleware('auth');
    Route::get('/info-legales', fn() => view('pages.info-legales'))->name('info-legales');
    Route::get('/confidentialite', fn() => view('pages.confidentialite'))->name('confidentialite');
    //supprimer le compte
    Route::delete('/profil', [ProfileController::class, 'destroy'])
        ->name('profile.destroy')
        ->middleware('auth');
    Route::get('/cookies', fn() => view('pages.cookies'))->name('cookies');
    Route::get('/parametres', fn() => view('pages.parametres'))->name('parametres');
    Route::get('/profil', [ProfileController::class, 'edit'])
        ->name('profile.edit')
        ->middleware('auth');

    Route::put('/profil', [ProfileController::class, 'update'])
        ->name('profile.update')
        ->middleware('auth');
    // Delete Account
    Route::post('/delete-account', [ConfidentialiteController::class, 'destroy'])->name('delete.account');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});
    /*
    |--------------------------------------------------------------------------
    | Zone protégée : administrateurs
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});



