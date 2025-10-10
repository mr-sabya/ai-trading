<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Banner as ModelsBanner;
use Livewire\Component;

class Banner extends Component
{
    public $banner;

    public function mount()
    {
        // Load the first banner record (you can make this dynamic later)
        $this->banner = ModelsBanner::first();
    }
    
    public function render()
    {
        return view('livewire.frontend.home.banner');
    }
}
