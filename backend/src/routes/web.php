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
use App\Http\Controllers\OnboardingController;


/*
|--------------------------------------------------------------------------
| Pages publiques
|--------------------------------------------------------------------------
*/

// Test DB
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
| Pages onboarding (accessibles même si onboarding non terminé)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('onboarding')->group(function () {
    Route::get('/1', [OnboardingController::class, 'page1'])->name('onboarding.1');
    Route::get('/2', [OnboardingController::class, 'page2'])->name('onboarding.2');
    Route::get('/3', [OnboardingController::class, 'page3'])->name('onboarding.3');
    Route::get('/4', [OnboardingController::class, 'page4'])->name('onboarding.4');
    Route::get('/5', [OnboardingController::class, 'page5'])->name('onboarding.5');


    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

    Route::post('/complete', function(Request $request) {
        $user = Auth::user();
        $user->onboarding_completed = true;
        $user->save();

        return redirect()->route('dashboard');
    })->name('onboarding.complete');
});

/*
|--------------------------------------------------------------------------
| Pages utilisateurs connectés (bloquées si onboarding pas fini)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','check.onboarding'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/reminder/{id}', [DashboardController::class, 'markDone'])
        ->name('dashboard.markDone');

    

    // Pages protégées supplémentaires
    Route::get('/assistance', fn() => view('pages.assistance'))->name('assistance');
    Route::get('/parametres', fn() => view('pages.parametres'))->name('parametres');
    Route::get('/confidentialite', fn() => view('pages.confidentialite'))->name('confidentialite');
    Route::get('/info-legales', fn() => view('pages.info-legales'))->name('info-legales');
    Route::get('/cookies', fn() => view('pages.cookies'))->name('cookies');
    


    // Profil
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Notifications
    Route::post('/notifications/update', function () {
        return back()->with('success', 'Notifications mises à jour');
    })->name('notifications.update');

    Route::get('/rappels', [ReminderController::class, 'index'])->name('rappels');
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

});


// Routes POST modales → hors onboarding
Route::middleware('auth')->group(function () {

    // Rappels
    Route::post('/rappels', [ReminderController::class, 'store'])->name('rappels.store');
    Route::post('/rappels/{id}/toggle', [ReminderController::class, 'toggle'])->name('rappels.toggle');
    Route::post('/rappels/clear-done', [ReminderController::class, 'clearDone'])->name('rappels.clearDone');

    // Médicaments
    Route::post('/medicaments', [MedicationController::class, 'store'])->name('medicaments.store');
    Route::put('/medicaments/{medicament}', [MedicationController::class, 'update'])->name('medicaments.update');
    Route::delete('/medicaments/{medicament}', [MedicationController::class, 'destroy'])->name('medicaments.destroy');
    Route::post('/dashboard/medicaments/{medicament}/done', [MedicationController::class, 'markDone'])->name('medicaments.markDone');

    // Contacts
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Hydratation
    Route::post('/hydratation', [HydratationController::class, 'store'])->name('hydratation.store');
});

/*
|--------------------------------------------------------------------------
| Zone administrateurs
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});
