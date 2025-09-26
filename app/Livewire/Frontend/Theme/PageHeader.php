<?php

namespace App\Livewire\Frontend\Theme;

use Livewire\Component;

class PageHeader extends Component
{

    // page title and bgImage
    public $title;
    public $bgImage;

    // mount function
    public function mount($pageTitle, $bgImage)
    {
        $this->title = $pageTitle;
        $this->bgImage = $bgImage;
    }

    public function render()
    {
        return view('livewire.frontend.theme.page-header');
    }
}
