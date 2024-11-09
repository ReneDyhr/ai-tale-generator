<?php

namespace App\Livewire;

use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\Story as StoryModel;
use Str;

class Story extends Component
{
    public string $uuid;
    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function render()
    {
        $story = StoryModel::where('uuid', $this->uuid)->first();
        return view('livewire.story', compact('story'));
    }
}
