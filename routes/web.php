<?php

use App\Livewire\Front\CustomerRegistrationForm;
use App\Livewire\Front\FormDetail;
use App\Livewire\Front\Forms\Thanks;
use App\Livewire\Front\Fortune;
use App\Livewire\Front\VehicleDetail;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/vehiculos/{category}/{slug}', VehicleDetail::class)->name('vehicle.detail');
Route::get('/fortuna', Fortune::class)->name('fortune');

Route::get('/forms', FormDetail::class)->name('forms.base');
Route::get('/forms/{category}', FormDetail::class)->name('forms.category');
Route::get('/forms/{category}/{slug}', FormDetail::class)->name('forms.detail');

// Páginas de agradecimiento (Livewire)
Route::get('/gracias', Thanks::class)->name('forms.thanks');
Route::get('/forms/{category}/{slug}/enviado', Thanks::class)->name('forms.thanks.vehicle');



Route::get('/clientegeely', CustomerRegistrationForm::class)->name('purchased.vehicle.form');
Route::get('/clientegeely/gracias', Thanks::class)->name('purchased.vehicle.thanks');


Route::middleware(['auth'])->group(function () {

    Route::view('dashboard', 'dashboard')->name('dashboard');

    Volt::route('backend/upload', 'backend.upload')->name('upload');

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
