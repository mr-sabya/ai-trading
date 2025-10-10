<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Faq as ModelsFaq;
use Livewire\Component;

class Faq extends Component
{
    public function render()
    {
        $faqs = ModelsFaq::orderBy('order')->get();
        return view('livewire.frontend.home.faq', compact('faqs'));
    }
}
