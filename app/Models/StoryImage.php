<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryImage extends Model
{
    protected $fillable = [
        'story_id',
        'style',
        'prompt',
        'image',
        'color',
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}
