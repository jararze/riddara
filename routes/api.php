<?php

use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/form-submissions', function() {
    return response()->json([
        'test_drive' => FormSubmission::where('tipo_formulario', 'test-drive')->get(),
        'cotizaciones' => FormSubmission::where('tipo_formulario', 'cotizacion')->get(),
        'consultas' => FormSubmission::where('tipo_formulario', 'consulta')->get(),
        'resumen' => FormSubmission::selectRaw('
            tipo_formulario,
            COUNT(*) as total,
            COUNT(CASE WHEN DATE(created_at) = CURDATE() THEN 1 END) as hoy,
            COUNT(CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) THEN 1 END) as esta_semana
        ')->groupBy('tipo_formulario')->get()
    ]);
});

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
        'Content-Type' => 'text/plain; charset=utf-8'
    ]);
});

Route::get('/export/purchased-data', function() {
    $submissions = \App\Models\PurchasedVehicleForm::orderBy('created_at', 'desc')->get();

    // Encabezados sin espacios ni caracteres especiales
    $output = "ID\tNombre\tApellido\tSegundoApellido\tGenero\tNacionalidad\tDocumentoID\tFechaNacimiento\tTelefono\tEmail\tQuierePromociones\tPromoWhatsApp\tPromoEmail\tPromoSMS\tSinPromociones\tCiudad\tBarrio\tDireccionCompleta\tEstadoCivil\tTieneHijos\tNumeroDeHijos\tCampoDeTrabajo\tNombreAsesor\tVehiculoComprado\tCaracteristicaAtractiva\tHobbies\tNivelEducacion\tConductorPrincipal\tFechaCreacion\tFechaActualizacion\n";

    foreach($submissions as $sub) {
        // Procesar hobbies como string
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
        'Content-Type' => 'text/plain; charset=utf-8'
    ]);
});
