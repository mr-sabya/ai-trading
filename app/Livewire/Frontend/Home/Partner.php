<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Partner as ModelsPartner;
use Livewire\Component;

class Partner extends Component
{
    public $partners;

    public function mount()
    {
        $this->partners = ModelsPartner::all();
    }
    
    public function render()
    {
        return view('livewire.frontend.home.partner');
    }
}
