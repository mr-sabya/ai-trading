<?php

namespace App\Livewire\Frontend\Home;

use App\Models\WebsiteFeature;
use Livewire\Component;

class Feature extends Component
{
    public $features = [];

    public function mount()
    {
        $this->features = WebsiteFeature::where('is_active', true)->get();
    }

    public function render()
    {
        return view('livewire.frontend.home.feature');
    }
}
