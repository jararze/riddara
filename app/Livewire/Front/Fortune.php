<?php

namespace App\Livewire\Front;

use Livewire\Component;

class Fortune extends Component
{
    public function render()
    {
        return view('livewire.front.fortune')->layout('components.layouts.frontend.front');
    }
}
