<?php

namespace App\Livewire\Front;

use Livewire\Component;

class Footer extends Component
{
    public $companyName = 'Geely Bolivia
';
    public $copyrightYear = 2025;
    public $phone = '(591)2-2795000';
    public $email = 'Av. Costanera # 1003, Los Pinos - La Paz, Bolivia';
    public $backgroundColor = '#000000';
    public $textColor = '#ffffff';
    public $linkColor = '#cccccc';
    public $columns;
    public $socialNetworks;
    public $legalLinks;

    public $logo = [
        'image' => '/frontend/images/logo-blanco.svg',
        'alt' => 'Geely Bolivia',
    ];

    public function mount()
    {
        $this->loadFooterData();
    }

    private function loadFooterData()
    {
        $this->columns = [
            [
                'id' => 'models',
                'title' => '',
                'links' => [
//                    ['text' => 'EX5', 'route' => 'models.ex5'],
//                    ['text' => 'Book Now', 'route' => 'book.now'],
//                    ['text' => 'Posventa', 'route' => 'posventa'],
//                    ['text' => 'Notifícame', 'route' => 'notify']
                ]
            ],
            [
                'id' => 'company',
                'title' => '',
                'links' => [
                    ['text' => 'Acerca de nosotros', 'route' => 'https://www.geely.com/en/brand/see-the-world-in-full'],
//                    ['text' => 'Calculadora', 'route' => 'calculator'],
                    ['text' => 'Noticias', 'route' => 'https://global.geely.com/en/news'],
//                    ['text' => 'Contáctanos', 'route' => 'contact']
                ]
            ],
            [
                'id' => 'services',
                'title' => '',
                'links' => [
//                    ['text' => 'Test Drive', 'route' => 'test-drive'],
//                    ['text' => 'Concesionario', 'route' => 'dealership'],
//                    ['text' => 'Promo & Event', 'route' => 'promotions']
                ]
            ]
        ];

        $this->socialNetworks = [
//            ['name' => 'WhatsApp', 'icon' => 'whatsapp', 'url' => 'https://wa.me/59100000000'],
            ['name' => 'Facebook', 'icon' => 'facebook', 'url' => 'https://www.facebook.com/profile.php?id=61583368379253'],
            ['name' => 'Instagram', 'icon' => 'instagram', 'url' => 'https://www.instagram.com/riddarabolivia/'],
            ['name' => 'YouTube', 'icon' => 'youtube', 'url' => 'https://www.youtube.com/@RiddaraBolivia'],
            ['name' => 'TikTok', 'icon' => 'tiktok', 'url' => 'https://www.tiktok.com/@riddarabolivia']
        ];

        $this->legalLinks = [
//            ['text' => 'Privacidad & Política', 'route' => 'privacy'],
//            ['text' => 'Política de cookies', 'route' => 'cookies'],
//            ['text' => 'Términos y Condiciones', 'route' => 'terms']
        ];
    }

    public function redirectTo($route)
    {
        return redirect()->route($route);
    }

    public function openSocialNetwork($url)
    {
        return redirect()->away($url);
    }
    public function render()
    {
        return view('livewire.front.footer');
    }
}
