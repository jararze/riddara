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



// Export routes (fuera de /api para evitar restricciones del servidor)
Route::get('/export/excel-data', function() {
    $submissions = \App\Models\FormSubmission::orderBy('created_at', 'desc')->get();

    $output = "ID\tFecha\tTipo\tNombre\tEmail\tTelefono\tCiudad\tVehiculo\tMensaje\tOfertas\n";

    foreach($submissions as $sub) {
        $output .= implode("\t", [
                $sub->id,
                $sub->created_at->format('d/m/Y H:i'),
                $sub->tipo_formulario,
                $sub->nombre,
                $sub->email,
                $sub->codigo_pais . ' ' . $sub->telefono,
                $sub->ciudad,
                $sub->vehiculo ?? '',
                str_replace(["\n", "\r", "\t"], ' ', $sub->mensaje ?? ''),
                $sub->receive_offers ? 'Sí' : 'No'
            ]) . "\n";
    }

    return response($output, 200, [
        'Content-Type' => 'text/tab-separated-values; charset=utf-8',
    ]);
});

Route::get('/export/purchased-data', function() {
    $submissions = \App\Models\PurchasedVehicleForm::orderBy('created_at', 'desc')->get();

    $output = "ID\tNombre\tApellido\tSegundoApellido\tGenero\tNacionalidad\tDocumentoID\tFechaNacimiento\tTelefono\tEmail\tQuierePromociones\tPromoWhatsApp\tPromoEmail\tPromoSMS\tSinPromociones\tCiudad\tBarrio\tDireccionCompleta\tEstadoCivil\tTieneHijos\tNumeroDeHijos\tCampoDeTrabajo\tNombreAsesor\tVehiculoComprado\tCaracteristicaAtractiva\tHobbies\tNivelEducacion\tConductorPrincipal\tFechaCreacion\tFechaActualizacion\n";

    foreach($submissions as $sub) {
        $hobbies = '';
        if ($sub->hobbies) {
            if (is_string($sub->hobbies)) {
                $hobbiesArray = json_decode($sub->hobbies, true);
                $hobbies = is_array($hobbiesArray) ? implode('; ', $hobbiesArray) : $sub->hobbies;
            } else if (is_array($sub->hobbies)) {
                $hobbies = implode('; ', $sub->hobbies);
            }
        }

        $output .= implode("\t", [
                $sub->id ?? '',
                $sub->first_name ?? '',
                $sub->last_name ?? '',
                $sub->second_last_name ?? '',
                $sub->gender ?? '',
                $sub->nationality ?? '',
                $sub->id_document ?? '',
                $sub->birth_date ? date('d/m/Y', strtotime($sub->birth_date)) : '',
                $sub->mobile_phone ?? '',
                $sub->email ?? '',
                $sub->wants_promotions ? 'Si' : 'No',
                $sub->promo_whatsapp ? 'Si' : 'No',
                $sub->promo_email ? 'Si' : 'No',
                $sub->promo_sms ? 'Si' : 'No',
                $sub->no_promotions ? 'Si' : 'No',
                $sub->city ?? '',
                $sub->neighborhood ?? '',
                str_replace(["\n", "\r", "\t"], ' ', $sub->full_address ?? ''),
                $sub->marital_status ?? '',
                $sub->has_children ? 'Si' : 'No',
                $sub->number_of_children ?? '',
                $sub->work_field ?? '',
                $sub->sales_advisor_name ?? '',
                $sub->purchased_vehicle ?? '',
                str_replace(["\n", "\r", "\t"], ' ', $sub->vehicle_attractive_feature ?? ''),
                str_replace(["\n", "\r", "\t"], ' ', $hobbies),
                $sub->education_level ?? '',
                $sub->main_driver ?? '',
                $sub->created_at ? $sub->created_at->format('d/m/Y H:i') : '',
                $sub->updated_at ? $sub->updated_at->format('d/m/Y H:i') : ''
            ]) . "\n";
    }

    return response($output, 200, [
        'Content-Type' => 'text/tab-separated-values; charset=utf-8',
    ]);
});




Route::middleware(['auth'])->group(function () {

    Route::view('dashboard', 'dashboard')->name('dashboard');

    Volt::route('backend/upload', 'backend.upload')->name('upload');

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
