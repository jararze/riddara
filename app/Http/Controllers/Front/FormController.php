<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function thanks(Request $request, $category = null, $slug = null)
    {
        // Obtener datos de la sesión
        $submission = session('form_submission');

        // Si no hay datos en sesión, redirigir al formulario
        if (!$submission) {
            return redirect()->route('forms.index');
        }

        return view('frontend.forms.thanks', [
            'submission' => $submission,
            'category' => $category,
            'slug' => $slug,
        ]);
    }
}
