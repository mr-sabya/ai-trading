<?php

namespace App\Livewire\Frontend\Home;

use App\Models\About as ModelsAbout;
use Livewire\Component;

class About extends Component
{
     public $about;

    public function mount()
    {
        $this->about = ModelsAbout::first();
    }
    
    public function render()
    {
        return view('livewire.frontend.home.about');
    }
}
