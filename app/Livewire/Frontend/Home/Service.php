<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Service as ModelsService;
use Livewire\Component;

class Service extends Component
{
    public function render()
    {
        $services = ModelsService::orderBy('order')->get();
        return view('livewire.frontend.home.service', compact('services'));
    }
}
