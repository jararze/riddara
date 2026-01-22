<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\PurchasedVehicleForm;
use Illuminate\Support\Facades\Log;

class CustomerRegistrationForm extends Component
{
    public $formData = [
        // Datos obligatorios
        'first_name' => '',
        'last_name' => '',
        'second_last_name' => '',
        'gender' => '',
        'nationality' => 'Boliviana',
        'id_document' => '',
        'birth_date' => '',
        'mobile_phone' => '',
        'email' => '',

        // Promociones
        'wants_promotions' => false,
        'promo_whatsapp' => false,
        'promo_email' => false,
        'promo_sms' => false,
        'no_promotions' => false,

        // Dirección
        'city' => '',
        'neighborhood' => '',
        'full_address' => '',

        // Estado civil
        'marital_status' => '',
        'has_children' => '',
        'number_of_children' => '',

        // Laboral y vehículo
        'work_field' => '',
        'sales_advisor_name' => '',
        'purchased_vehicle' => '',
        'vehicle_attractive_feature' => '',

        // Opcionales
        'hobbies' => [],
        'education_level' => '',
        'main_driver' => ''
    ];

    public $nationalities = [
        'Boliviana', 'Argentina', 'Brasileña', 'Chilena', 'Peruana',
        'Colombiana', 'Ecuatoriana', 'Paraguaya', 'Uruguaya', 'Otra'
    ];

    public $cities = [
        'La Paz', 'Santa Cruz', 'Cochabamba', 'Oruro', 'Potosí',
        'Tarija', 'Sucre', 'Trinidad', 'El Alto'
    ];

    public $vehicles = [
        'starray' => 'Starray',
        'gx3-pro' => 'GX3 Pro',
        'cityray' => 'Cityray',
        'coolray' => 'Coolray Lite',
    ];

    public $hobbiesOptions = [
        'futbol' => 'Fútbol',
        'otros_deportes' => 'Otros deportes',
        'musica' => 'Música',
        'peliculas' => 'Películas, series y cine',
        'videojuegos' => 'Videojuegos',
        'literatura' => 'Literatura y lectura',
        'viajes' => 'Viajes y turismo',
        'aventura' => 'Aventura y adrenalina',
        'artes' => 'Pintura, escultura y artes plásticas',
        'manualidades' => 'Manualidades, jardinería, otros',
        'mascotas' => 'Mascotas',
        'cocina' => 'Cocina, comida y bebida'
    ];

    protected $rules = [
        'formData.first_name' => 'required|string|min:2|max:50',
        'formData.last_name' => 'required|string|min:2|max:50',
        'formData.second_last_name' => 'required|string|min:2|max:50',
        'formData.gender' => 'required|in:masculino,femenino,otro',
        'formData.nationality' => 'required|string',
        'formData.id_document' => 'required|string|min:5|max:20',
        'formData.birth_date' => 'required|date|before:today',
        'formData.mobile_phone' => 'required|string|min:7|max:20',
        'formData.email' => 'required|email|max:255',
        'formData.city' => 'required|string',
        'formData.neighborhood' => 'required|string|max:100',
        'formData.full_address' => 'required|string|max:255',
        'formData.marital_status' => 'required|in:soltero,casado,divorciado,viudo',
        'formData.has_children' => 'required|in:si,no',
        'formData.number_of_children' => 'required_if:formData.has_children,si|nullable|integer|min:1|max:20',
        'formData.work_field' => 'required|string|max:100',
        'formData.sales_advisor_name' => 'required|string|max:100',
        'formData.purchased_vehicle' => 'required|string',
        'formData.vehicle_attractive_feature' => 'required|string|max:500'
    ];

    protected $messages = [
        'formData.first_name.required' => 'El nombre es obligatorio.',
        'formData.last_name.required' => 'El apellido paterno es obligatorio.',
        'formData.second_last_name.required' => 'El apellido materno es obligatorio.',
        'formData.gender.required' => 'El sexo es obligatorio.',
        'formData.id_document.required' => 'El carnet/pasaporte es obligatorio.',
        'formData.birth_date.required' => 'La fecha de nacimiento es obligatoria.',
        'formData.birth_date.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
        'formData.mobile_phone.required' => 'El número de teléfono es obligatorio.',
        'formData.email.required' => 'El correo electrónico es obligatorio.',
        'formData.email.email' => 'Ingrese un correo electrónico válido.',
        'formData.city.required' => 'La ciudad es obligatoria.',
        'formData.neighborhood.required' => 'La zona o barrio es obligatorio.',
        'formData.full_address.required' => 'La dirección completa es obligatoria.',
        'formData.marital_status.required' => 'El estado civil es obligatorio.',
        'formData.work_field.required' => 'El campo laboral es obligatorio.',
        'formData.sales_advisor_name.required' => 'El nombre del asesor es obligatorio.',
        'formData.purchased_vehicle.required' => 'Debe seleccionar el vehículo adquirido.',
        'formData.has_children.required' => 'Debe indicar si tiene hijos.',
        'formData.has_children.in' => 'Debe seleccionar una opción válida.',
        'formData.number_of_children.required_if' => 'Si tiene hijos, debe especificar cuántos.',
        'formData.number_of_children.min' => 'Debe tener al menos 1 hijo.',
        'formData.vehicle_attractive_feature.required' => 'Debe indicar qué le llamó más la atención del vehículo.'
    ];

    public function updatedFormDataNoPromotions($value)
    {
        if ($value) {
            $this->formData['promo_whatsapp'] = false;
            $this->formData['promo_email'] = false;
            $this->formData['promo_sms'] = false;
            $this->formData['wants_promotions'] = false;
        }
    }

    public function updatedFormDataHasChildren($value)
    {
        if ($value === 'no') {
            $this->formData['number_of_children'] = '';
        }
    }

    /**
     * Obtener IP real del cliente (compatible con Cloudflare)
     */
    private function getClientIp(): string
    {
        if ($ip = request()->header('CF-Connecting-IP')) {
            return $ip;
        }

        if ($forwarded = request()->header('X-Forwarded-For')) {
            return explode(',', $forwarded)[0];
        }

        return request()->ip();
    }

    public function submitForm()
    {
        Log::info('Iniciando envío de formulario', ['formData' => $this->formData]);

        try {
            $this->validate();

            $wantsPromotions = $this->formData['promo_whatsapp'] ||
                $this->formData['promo_email'] ||
                $this->formData['promo_sms'];

            $submission = PurchasedVehicleForm::create([
                'first_name' => $this->formData['first_name'],
                'last_name' => $this->formData['last_name'],
                'second_last_name' => $this->formData['second_last_name'],
                'gender' => $this->formData['gender'],
                'nationality' => $this->formData['nationality'],
                'id_document' => $this->formData['id_document'],
                'birth_date' => $this->formData['birth_date'],
                'mobile_phone' => $this->formData['mobile_phone'],
                'email' => $this->formData['email'],
                'ip_address' => $this->getClientIp(),
                'wants_promotions' => $wantsPromotions,
                'promo_whatsapp' => $this->formData['promo_whatsapp'],
                'promo_email' => $this->formData['promo_email'],
                'promo_sms' => $this->formData['promo_sms'],
                'no_promotions' => $this->formData['no_promotions'],
                'city' => $this->formData['city'],
                'neighborhood' => $this->formData['neighborhood'],
                'full_address' => $this->formData['full_address'],
                'marital_status' => $this->formData['marital_status'],
                'has_children' => $this->formData['has_children'] === 'si',
                'number_of_children' => $this->formData['has_children'] === 'si' ? (int)$this->formData['number_of_children'] : null,
                'work_field' => $this->formData['work_field'],
                'sales_advisor_name' => $this->formData['sales_advisor_name'],
                'purchased_vehicle' => $this->formData['purchased_vehicle'],
                'vehicle_attractive_feature' => $this->formData['vehicle_attractive_feature'],
                'hobbies' => !empty($this->formData['hobbies']) ? json_encode($this->formData['hobbies']) : null,
                'education_level' => $this->formData['education_level'] ?: null,
                'main_driver' => $this->formData['main_driver'] ?: null
            ]);

            Log::info('Formulario de vehículo comprado enviado exitosamente:', [
                'submission_id' => $submission->id,
                'email' => $submission->email,
                'vehicle' => $submission->purchased_vehicle,
                'ip' => $this->getClientIp()
            ]);

            // Guardar datos en sesión para la página de agradecimiento
            session()->flash('form_submission', [
                'nombre' => $this->formData['first_name'] . ' ' . $this->formData['last_name'],
                'email' => $this->formData['email'],
                'vehiculo' => $this->vehicles[$this->formData['purchased_vehicle']] ?? $this->formData['purchased_vehicle'],
                'tipo' => 'registro-cliente',
                'id' => $submission->id,
            ]);

            // Limpiar formulario
            $this->reset('formData');
            $this->formData['nationality'] = 'Boliviana';

            // Redirigir a página de agradecimiento
            return redirect()->route('forms.thanks');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Error de validación en formulario:', [
                'errors' => $e->errors(),
                'formData' => $this->formData
            ]);
            throw $e;

        } catch (\Exception $e) {
            Log::error('Error al enviar formulario de vehículo comprado:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'formData' => $this->formData
            ]);

            session()->flash('error', 'Ocurrió un error al procesar el formulario. Por favor intente nuevamente.');
        }
    }

    public function render()
    {
        return view('livewire.front.customer-registration-form')->layout('components.layouts.frontend.front');
    }
}
