<?php

namespace App\Livewire\Frontend\Home;

use App\Models\TeamMember;
use Livewire\Component;

class Team extends Component
{
    public function render()
    {
        $teamMembers = TeamMember::orderBy('order')->get();
        return view('livewire.frontend.home.team', compact('teamMembers'));
    }
}
