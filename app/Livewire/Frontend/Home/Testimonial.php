<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Testimonial as ModelsTestimonial;
use Livewire\Component;

class Testimonial extends Component
{
    public function render()
    {
        $testimonials = ModelsTestimonial::latest()->get();
        return view('livewire.frontend.home.testimonial', compact('testimonials'));
    }
}
