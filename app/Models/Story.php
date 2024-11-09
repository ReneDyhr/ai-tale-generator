<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{

    protected $fillable = [
        'uuid',
        'story',
        'length',
        'age',
        'language',
        'generated_story',
        'colour',
        'model',
        'ip_address',
    ];

    public function images()
    {
        return $this->hasMany(StoryImage::class);
    }

    public function getGeneratedStoryAttribute($value)
    {
        return json_decode($value);
    }

    public function setGeneratedStoryAttribute($value)
    {
        $this->attributes['generated_story'] = json_encode($value);
    }

    public function getGeneratedStoryHtmlAttribute()
    {
        $story = $this->generated_story->choices[0]->message->content;
        $story = explode("\n", $story);
        // Remove first element from array
        array_shift($story);

        // return $this->generated_story->choices[0]->message->content;
        return implode("\n", $story);
    }

    public function getGeneratedStoryHeaderHtmlAttribute()
    {
        $story = $this->generated_story->choices[0]->message->content;
        // Remove # from the beginning of the string if it exists
        $story = ltrim($story, '# ');

        $story = explode("\n", $story);

        return $story[0];
    }
}
