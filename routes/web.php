<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SharedListsController;
use App\Http\Controllers\GoogleAuthController;
use Livewire\Volt\Volt;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    // Dashboard que muestra listas y detalle según query
    Route::get('/dashboard', [ShoppingListController::class, 'index'])->name('dashboard');  
    Route::get('/shared-lists', [SharedListsController::class, 'index'])->name('shared.lists');
    Route::post('/lists/{list}/share', [SharedListsController::class, 'store'])->name('lists.share');

    // Listas
    Route::post('/shopping-lists', [ShoppingListController::class, 'store'])->name('shopping-lists.store');
    Route::post('/shopping-lists/{id}/update', [ShoppingListController::class, 'update'])->name('shopping-lists.update');
    Route::post('/shopping-lists/{id}/delete', [ShoppingListController::class, 'destroy'])->name('shopping-lists.destroy');

    // Productos
    Route::post('/shopping-lists/{list}/products', [ProductController::class, 'store'])->name('products.store');
    Route::post('/products/{id}/inc', [ProductController::class, 'inc'])->name('products.inc');
    Route::post('/products/{id}/dec', [ProductController::class, 'dec'])->name('products.dec');
    Route::post('/products/{id}/delete', [ProductController::class, 'destroy'])->name('products.destroy');

    // Compartidos
    Route::post('/lists/{list}/unshare-all', [SharedListsController::class, 'unshareAll'])->name('lists.unshareAll');
    Route::post('/lists/{list}/unshare-me', [SharedListsController::class, 'unshareMe'])->name('lists.unshareMe');
});



Route::get('/google-auth/login', [GoogleAuthController::class, 'redirectLogin'])->name('google.login');
Route::get('/google-auth/register', [GoogleAuthController::class, 'redirectRegister'])->name('google.register');
Route::get('/google-auth/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
