<?php

namespace App\Livewire\Front\Forms;

use Livewire\Component;

class Thanks extends Component
{
    public $submission = null;
    public $category = null;
    public $slug = null;

    public function mount($category = null, $slug = null)
    {
        $this->category = $category;
        $this->slug = $slug;

        $this->submission = session('form_submission');

        if (!$this->submission) {
            if ($this->category && $this->slug) {
                return redirect()->route('forms.detail', [
                    'category' => $this->category,
                    'slug' => $this->slug
                ]);
            }
            return redirect()->route('forms.base');
        }
    }

    public function render()
    {
        return view('livewire.front.thanks')->layout('components.layouts.frontend.front');
    }
}
