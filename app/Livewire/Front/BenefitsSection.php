<?php

namespace App\Livewire\Front;

use Livewire\Component;

class BenefitsSection extends Component
{
    public $sectionTitle = 'Con Riddara obtienes más';
    public $sectionDescription = 'Recibe los mejores beneficios y condiciones de mercado para que puedas conducir con total tranquilidad.';


// Configuración de fondo
    public $backgroundType = 'image'; // 'gradient' o 'image'

    public $backgroundImage = 'assets/images/bg-benefits.png'; // Tu imagen de fondo
    public $backgroundOverlay = true; // Mantener overlay para legibilidad del texto
    public $backgroundColor = '#3b82f6';
    public $gradientEndColor = '#3B4C39';
    public $gradientDirection = '0';
    public $overlayOpacity = 0; // Opacidad del overlay (0-1)

    public $footerText = 'Lo que ocurra primero';
    public $benefits;

    public $cardBackgroundImage = 'assets/images/box.png';

    public function mount()
    {
        $this->loadBenefits();

        // Ejemplo 1: Degradado azul (por defecto)
//         $this->setGradientBackground('#3b82f6', '#3B4C39', '135deg');

        // Ejemplo 2: Degradado morado
        // $this->setGradientBackground('#8b5cf6', '#5b21b6', '135deg');

        // Ejemplo 3: Imagen de fondo con overlay
//        $this->setImageBackground('assets/images/geely-hero-bg.png', true, 0.5, -90);

        // Ejemplo 4: Imagen sin overlay
        // $this->setImageBackground('/images/geely-hero-bg.jpg', false);
    }

    public function getBackgroundStyle()
    {
        switch ($this->backgroundType) {
            case 'image':
                if (!$this->backgroundImage) {
                    return $this->getGradientStyle(); // Quita asset() de aquí
                }

                // Usa asset() para la imagen
                $imageUrl = asset($this->backgroundImage);

                $overlay = $this->backgroundOverlay
                    ? "linear-gradient(rgba(0,0,0,{$this->overlayOpacity}), rgba(0,0,0,{$this->overlayOpacity})), "
                    : '';

                return "background: {$overlay}url('{$imageUrl}') center/cover no-repeat;";

            case 'solid':
                return "background-color: {$this->backgroundColor};";

            case 'gradient':
            default:
                return $this->getGradientStyle();
        }
    }

    private function getGradientStyle()
    {
        return "background: linear-gradient({$this->gradientDirection}, {$this->backgroundColor}, {$this->gradientEndColor});";
    }

    private function loadBenefits()
    {
        $this->benefits = [
            [
                'id' => 'warranty-years',
                'number' => '5',
                'unit' => 'AÑOS',
                'label' => 'GARANTÍA EXTENDIDA',
                'position' => 1
            ],
            [
                'id' => 'warranty-km',
                'number' => '150.000',
                'unit' => 'KM',
                'label' => '',
                'position' => 2
            ],
            [
                'id' => 'services',
                'number' => '6',
                'unit' => 'SERVICIOS',
                'label' => 'Y MANTENIMIENTOS INCLUIDOS',
                'position' => 3
            ],
            [
                'id' => 'maintenance-years',
                'number' => '3',
                'unit' => 'AÑOS',
                'label' => 'EN',
                'position' => 4
            ]
        ];
    }

    public function setGradientBackground($startColor, $endColor, $direction = '135deg')
    {
        $this->backgroundType = 'gradient';
        $this->backgroundColor = $startColor;
        $this->gradientEndColor = $endColor;
        $this->gradientDirection = $direction;
    }

    public function setImageBackground($imageUrl, $useOverlay = true, $overlayOpacity = 0.7, $rotation = 0)
    {
        $this->backgroundType = 'image';
        $this->backgroundImage = $imageUrl;
        $this->backgroundOverlay = $useOverlay;
        $this->overlayOpacity = $overlayOpacity;
        $this->backgroundRotation = $rotation;
    }

    public function toggleBackgroundType()
    {
        $this->backgroundType = $this->backgroundType === 'gradient' ? 'image' : 'gradient';
    }

    public function render()
    {
        return view('livewire.front.benefits-section');
    }
}
