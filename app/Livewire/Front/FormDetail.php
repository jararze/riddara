<?php

namespace App\Livewire\Front;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Models\FormSubmission;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class FormDetail extends Component
{
    public $category = null;
    public $slug = null;
    public $activeTab = 'test-drive';
    public $selectedVehicle = null;

    public $paisSeleccionado = 'bolivia';

    public $formData = [
        'nombre' => '',
        'email' => '',
        'telefono' => '',
        'ciudad' => '',
        'vehiculo' => '',
        'mensaje' => '',
        'codigo_pais' => '+591',
        'receive_offers' => false
    ];

    public $paises = [
        'bolivia' => [
            'codigo' => '+591',
            'codigo_iso' => 'bo',
            'nombre' => 'Bolivia'
        ],
        'argentina' => [
            'codigo' => '+54',
            'codigo_iso' => 'ar',
            'nombre' => 'Argentina'
        ],
        'brasil' => [
            'codigo' => '+55',
            'codigo_iso' => 'br',
            'nombre' => 'Brasil'
        ],
        'chile' => [
            'codigo' => '+56',
            'codigo_iso' => 'cl',
            'nombre' => 'Chile'
        ],
        'peru' => [
            'codigo' => '+51',
            'codigo_iso' => 'pe',
            'nombre' => 'Perú'
        ],
        'colombia' => [
            'codigo' => '+57',
            'codigo_iso' => 'co',
            'nombre' => 'Colombia'
        ],
        'ecuador' => [
            'codigo' => '+593',
            'codigo_iso' => 'ec',
            'nombre' => 'Ecuador'
        ],
        'paraguay' => [
            'codigo' => '+595',
            'codigo_iso' => 'py',
            'nombre' => 'Paraguay'
        ],
        'uruguay' => [
            'codigo' => '+598',
            'codigo_iso' => 'uy',
            'nombre' => 'Uruguay'
        ]
    ];

    public $pageData = [
        'title' => 'PRUEBA UNA RIDDARA POR TI MISMO',
        'description' => 'Escoge cómo deseas vivir tu experiencia Riddara',
        'tabs' => [
            'test-drive' => [
                'title' => 'TEST DRIVE',
                'description' => 'Agenda tu Test Drive y descubre la emoción de manejar una Riddara.'
            ],
            'cotizacion' => [
                'title' => 'COTIZACIÓN',
                'description' => 'Genera una proforma automática del vehículo de tu preferencia.'
            ],
            'consulta' => [
                'title' => 'OTRA CONSULTA',
                'description' => 'Contáctate con nosotros si tienes alguna otra consulta.'
            ]
        ],
        'sucursales' => [
            'title' => 'NUESTRAS SUCURSALES',
            'description' => 'Para mejorar la comodidad del cliente, Riddara está desarrollando su red de ventas en toda Bolivia, para ofrecer fácil acceso a nuestros vehículos innovadores.',
            'info' => 'Actualmente, 2 showrooms ya están operativos y abiertos para visitas, como se detalla a continuación:',
            'locations' => ['1. Santa Cruz', '2. El Alto'],
            'additional_info' => 'Los concesionarios restantes están programados para abrir próximamente, ampliando aún más nuestra cobertura y mejorando la accesibilidad para los clientes de Riddara en todo el país.',
            'image' => 'frontend/images/form2.png'
        ]
    ];

    // Lista de vehículos disponibles
    public $availableVehicles = [
        'electricos' => [
            'rd6-electrica-bev-pro-4x4' => 'RD6 ELÉCTRICA BEV PRO 4X4',
            'rd6-electrica-bev-econ-4x2' => 'RD6 ELÉCTRICA BEV ECON 4X2',
            'rd6-electrica-bev-econ-4x4' => 'RD6 ELÉCTRICA BEV ECON 4X4'
        ],
        'hibridos' => [
            'rd6-hibrida-bev-phev-gl-4x4' => 'RD6 HÍBRIDA BEV PHEV GL 4X4',
            'rd6-hibrida-bev-phev-gs-4x4' => 'RD6 HÍBRIDA BEV PHEV GS 4X4'
        ],
    ];

    public function mount($category = null, $slug = null)
    {
        $this->category = $category;
        $this->slug = $slug;

        // Si viene con categoría y slug, pre-seleccionar el vehículo
        if ($this->category && $this->slug) {
            $this->selectedVehicle = [
                'category' => $this->category,
                'slug' => $this->slug,
                'name' => $this->getVehicleName($this->category, $this->slug)
            ];
            $this->formData['vehiculo'] = $this->selectedVehicle['name'];
            // Si viene de un auto específico, ir directo a cotización
            $this->activeTab = 'cotizacion';
        }
    }

    private function getVehicleName($category, $slug)
    {
        return $this->availableVehicles[$category][$slug] ?? ucfirst($slug);
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function getAllVehicles()
    {
        $vehicles = [];
        foreach ($this->availableVehicles as $category => $categoryVehicles) {
            foreach ($categoryVehicles as $slug => $name) {
                $vehicles[] = [
                    'value' => $name,
                    'label' => $name,
                    'category' => $category,
                    'slug' => $slug
                ];
            }
        }
        return $vehicles;
    }

    public function submitForm()
    {
        $rules = [
            'formData.nombre' => 'required|string|min:2',
            'formData.email' => 'required|email',
            'formData.telefono' => 'required|string',
            'formData.ciudad' => 'required|string'
        ];

        // Si no hay vehículo pre-seleccionado, requerirlo
        if (!$this->selectedVehicle) {
            $rules['formData.vehiculo'] = 'required|string';
        }

        $this->validate($rules);

        // Procesar formulario según el tab activo
        $formSubmission = $this->processForm();

        // Enviar a Tecnom CRM si es cotización o test drive
        if (in_array($this->activeTab, ['cotizacion', 'test-drive'])) {
            $this->sendToTecnomCRM($formSubmission);
        }

        session()->flash('message', 'Formulario enviado correctamente. Te contactaremos pronto.');
        $this->reset(['formData']);

        // Mantener vehículo seleccionado si viene por URL
        if ($this->selectedVehicle) {
            $this->formData['vehiculo'] = $this->selectedVehicle['name'];
        }
    }

    private function processForm()
    {
        $data = [
            'tipo_formulario' => $this->activeTab,
            'nombre' => $this->formData['nombre'],
            'email' => $this->formData['email'],
            'telefono' => $this->formData['telefono'],
            'codigo_pais' => $this->formData['codigo_pais'],
            'ciudad' => $this->formData['ciudad'],
            'vehiculo' => $this->formData['vehiculo'],
            'mensaje' => $this->formData['mensaje'] ?? null,
            'receive_offers' => $this->formData['receive_offers'],
            'categoria_vehiculo' => $this->selectedVehicle['category'] ?? null,
            'slug_vehiculo' => $this->selectedVehicle['slug'] ?? null,
            'datos_completos' => [
                'formData' => $this->formData,
                'selectedVehicle' => $this->selectedVehicle,
                'timestamp' => now()
            ],
            // Campos iniciales para CRM
            'status' => FormSubmission::STATUS_PENDING,
            'attempt_count' => 0
        ];

        // Guardar en base de datos
        $formSubmission = FormSubmission::create($data);

        // Log para debugging
        Log::info('Formulario guardado en BD:', ['form_id' => $formSubmission->id, 'tipo' => $this->activeTab]);

        return $formSubmission;
    }

    /**
     * Enviar datos a Tecnom CRM
     */
    private function sendToTecnomCRM(FormSubmission $formSubmission)
    {
        // Incrementar contador de intentos
        $formSubmission->increment('attempt_count');
        $formSubmission->update(['last_attempt_at' => now()]);

        try {
            // Asignar agente basado en la ciudad
            $agent = $this->assignAgent($formSubmission->ciudad);

            // Preparar datos para API
            $apiData = $this->prepareApiDataForTecnom($formSubmission, $agent);

            // Enviar a API
            $response = $this->sendTecnomAPIRequest($apiData);
            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            if ($statusCode == 200) {
                // Caso de éxito
                $result = json_decode($responseBody, true);
                $formSubmission->update([
                    'tecnom_id' => $result['id'] ?? null,
                    'status' => FormSubmission::STATUS_SENT_TO_CRM,
                    'sent_to_crm_at' => now(),
                    'agent_assigned' => $agent ? $agent->email : null,
                    'tecnom_response' => $result,
                    'error_tecnom' => null // Limpiar errores previos
                ]);

                Log::info('Enviado exitosamente a Tecnom CRM:', [
                    'form_id' => $formSubmission->id,
                    'tecnom_id' => $result['id'] ?? null,
                    'agent_email' => $agent ? $agent->email : null,
                    'ciudad' => $formSubmission->ciudad,
                    'attempts' => $formSubmission->attempt_count
                ]);

            } elseif ($statusCode == 400) {
                // Error esperado (bad request)
                $formSubmission->update([
                    'error_tecnom' => 'Error 400 - Bad Request: ' . $responseBody,
                    'status' => FormSubmission::STATUS_ERROR,
                    'tecnom_response' => ['error' => $responseBody, 'status_code' => 400]
                ]);

                Log::warning('Error 400 en Tecnom CRM:', [
                    'form_id' => $formSubmission->id,
                    'response' => $responseBody,
                    'attempts' => $formSubmission->attempt_count
                ]);

            } else {
                // Error inesperado
                $formSubmission->update([
                    'error_tecnom' => "Error {$statusCode}: {$responseBody}",
                    'status' => FormSubmission::STATUS_ERROR,
                    'tecnom_response' => ['error' => $responseBody, 'status_code' => $statusCode]
                ]);

                Log::error('Error inesperado en Tecnom CRM:', [
                    'form_id' => $formSubmission->id,
                    'status_code' => $statusCode,
                    'response' => $responseBody,
                    'attempts' => $formSubmission->attempt_count
                ]);
            }

        } catch (GuzzleException $e) {
            $formSubmission->update([
                'error_tecnom' => 'Exception: ' . $e->getMessage(),
                'status' => FormSubmission::STATUS_ERROR,
                'tecnom_response' => [
                    'exception' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            ]);

            Log::error('Excepción al enviar a Tecnom CRM:', [
                'form_id' => $formSubmission->id,
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'attempts' => $formSubmission->attempt_count
            ]);
        } catch (\Exception $e) {
            $formSubmission->update([
                'error_tecnom' => 'Unexpected Error: ' . $e->getMessage(),
                'status' => FormSubmission::STATUS_ERROR,
                'tecnom_response' => [
                    'unexpected_error' => $e->getMessage(),
                    'code' => $e->getCode()
                ]
            ]);

            Log::error('Error inesperado al procesar Tecnom CRM:', [
                'form_id' => $formSubmission->id,
                'error' => $e->getMessage(),
                'attempts' => $formSubmission->attempt_count
            ]);
        }
    }

    /**
     * Asignar agente basado en la ciudad seleccionada
     */
    private function assignAgent($ciudad = null)
    {
        // Agentes estáticos basados en ciudad
        $agentes = [
            // Grupo 1: Santa Cruz, Cochabamba, Sucre, Tarija, Trinidad
            'santa-cruz' => [
                ['email' => 'pbeltran@taiyomotors.com.bo', 'nombre' => 'Pablo Beltrán'],
                ['email' => 'dvelasco@taiyomotors.com.bo', 'nombre' => 'Douglas Velasco']
            ],
            'cochabamba' => [
                ['email' => 'pbeltran@taiyomotors.com.bo', 'nombre' => 'Pablo Beltrán'],
                ['email' => 'dvelasco@taiyomotors.com.bo', 'nombre' => 'Douglas Velasco']
            ],
            'sucre' => [
                ['email' => 'pbeltran@taiyomotors.com.bo', 'nombre' => 'Pablo Beltrán'],
                ['email' => 'dvelasco@taiyomotors.com.bo', 'nombre' => 'Douglas Velasco']
            ],
            'tarija' => [
                ['email' => 'pbeltran@taiyomotors.com.bo', 'nombre' => 'Pablo Beltrán'],
                ['email' => 'dvelasco@taiyomotors.com.bo', 'nombre' => 'Douglas Velasco']
            ],
            'trinidad' => [
                ['email' => 'pbeltran@taiyomotors.com.bo', 'nombre' => 'Pablo Beltrán'],
                ['email' => 'dvelasco@taiyomotors.com.bo', 'nombre' => 'Douglas Velasco']
            ],

            // Grupo 2: Oruro, La Paz, El Alto, Potosí
            'oruro' => [
                ['email' => 'ibaptista@taiyomotors.com.bo', 'nombre' => 'Ivan Baptista']
            ],
            'la-paz' => [
                ['email' => 'lcupari@taiyomotors.com.bo', 'nombre' => 'Luis Cupari']
            ],
            'el-alto' => [
                ['email' => 'lcupari@taiyomotors.com.bo', 'nombre' => 'Luis Cupari']
            ],
            'potosi' => [
                ['email' => 'lcupari@taiyomotors.com.bo', 'nombre' => 'Luis Cupari']
            ]
        ];

        try {
            if (!$ciudad || !isset($agentes[$ciudad])) {
                Log::warning('Ciudad no válida para asignación de agente:', ['ciudad' => $ciudad]);
                // Fallback: usar Pablo Beltrán por defecto
                return (object) ['email' => 'pbeltran@taiyomotors.com.bo', 'nombre' => 'Pablo Beltrán'];
            }

            $agentesDisponibles = $agentes[$ciudad];

            // Si solo hay un agente para la ciudad, asignarlo directamente
            if (count($agentesDisponibles) === 1) {
                $agenteSeleccionado = $agentesDisponibles[0];
                Log::info('Agente único asignado:', ['ciudad' => $ciudad, 'agente' => $agenteSeleccionado['email']]);
                return (object) $agenteSeleccionado;
            }

            // Para ciudades con múltiples agentes, implementar rotación simple
            // Usar el timestamp actual para alternar entre agentes
            $indiceAgente = (int)(time() / 3600) % count($agentesDisponibles); // Cambia cada hora
            $agenteSeleccionado = $agentesDisponibles[$indiceAgente];

            Log::info('Agente rotativo asignado:', [
                'ciudad' => $ciudad,
                'agente' => $agenteSeleccionado['email'],
                'indice' => $indiceAgente
            ]);

            return (object) $agenteSeleccionado;

        } catch (\Exception $e) {
            Log::error('Error al asignar agente:', ['error' => $e->getMessage(), 'ciudad' => $ciudad]);
            // Fallback en caso de error
            return (object) ['email' => 'pbeltran@taiyomotors.com.bo', 'nombre' => 'Pablo Beltrán'];
        }
    }

    /**
     * Preparar datos para la API de Tecnom usando la estructura exacta del código original
     */
    private function prepareApiDataForTecnom(FormSubmission $formSubmission, $agent = null)
    {
        $testDrive = $this->activeTab === 'test-drive' ? 'Si' : 'No';
        $tipoContacto = $this->activeTab === 'test-drive' ? 'test-drive' : 'cotizacion';

        // Separar nombre y apellido
        $nombreCompleto = explode(' ', $formSubmission->nombre, 2);
        $nombre = $nombreCompleto[0] ?? $formSubmission->nombre;
        $apellido = $nombreCompleto[1] ?? '';

        // Comentarios en el mismo formato que el código original
        $comentarios = "Cotizacion de pagina web, el id es el: {$formSubmission->id}.\n";
        $comentarios .= "Datos:\n";
        $comentarios .= "Ciudad: {$formSubmission->ciudad}\n";
        $comentarios .= "Telefono: {$formSubmission->codigo_pais}{$formSubmission->telefono}\n";
        $comentarios .= "Vehiculo: {$formSubmission->vehiculo}\n";
        $comentarios .= "Requiere Test Drive: {$testDrive}\n";
        $comentarios .= "Contacto por: {$tipoContacto}";

        if ($formSubmission->mensaje) {
            $comentarios .= "\nMensaje adicional: {$formSubmission->mensaje}";
        }

        $apiData = [
            'prospect' => [
                'requestdate' => date('c'),
                'customer' => [
                    'comments' => $comentarios,
                    'contacts' => [
                        [
                            'emails' => [
                                [
                                    'value' => $formSubmission->email
                                ]
                            ],
                            'names' => [
                                [
                                    'part' => 'first',
                                    'value' => $nombre
                                ],
                                [
                                    'part' => 'last',
                                    'value' => $apellido
                                ]
                            ],
                            'phones' => [
                                [
                                    'type' => 'cellphone',
                                    'value' => $formSubmission->codigo_pais . $formSubmission->telefono
                                ]
                            ],
                            'addresses' => [
                                [
                                    'city' => $formSubmission->ciudad,
                                    'postalcode' => '591'
                                ]
                            ],
                        ],
                    ]
                ],
                'vehicles' => [
                    [
                        'make' => 'Geely', // Cambiar de Nissan a Geely
                        'model' => $formSubmission->vehiculo,
                        'trim' => $formSubmission->vehiculo,
                        'year' => date('Y') // Año actual como fallback
                    ]
                ],
                'provider' => [
                    'name' => [
                        'value' => 'Sitio web'
                    ],
                    'service' => ''
                ],
                'vendor' => [
                    'contacts' => [],
                    'vendorname' => [
                        'value' => $agent ? $agent->email : 'web@geely.com.bo'
                    ]
                ]
            ]
        ];

        return $apiData;
    }

    /**
     * Enviar request a la API de Tecnom
     */
    private function sendTecnomAPIRequest(array $apiData)
    {
        $client = new Client();
        $credentials = $this->getTecnomAPICredentials();

        $response = $client->post(config('app.api_url'), [
            'json' => $apiData,
            'auth' => [$credentials['username'], $credentials['password']],
            'timeout' => 30,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ]);

        return $response;
    }

    /**
     * Obtener credenciales de la API
     */
    private function getTecnomAPICredentials(): array
    {
        return [
            'username' => config('app.api_username'),
            'password' => config('app.api_password'),
        ];
    }

    public function cambiarPais($pais)
    {
        $this->paisSeleccionado = $pais;
        $this->formData['codigo_pais'] = $this->paises[$pais]['codigo'];
    }

    public function render()
    {
        return view('livewire.front.form-detail')->layout('components.layouts.frontend.front');
    }
}
