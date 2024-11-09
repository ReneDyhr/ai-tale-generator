<?php

namespace App\Livewire;

use App\Models\Story;
use App\Models\StoryImage;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;
use Str;

class Homepage extends Component
{
    public string $story = '';

    public string $length = '';

    public string $age = '';

    public string $language = 'danish';

    public function render()
    {
        // $image = StoryImage::latest('id')->first();
        // $story = Story::latest('id')->first();
        // $content = $story->generated_story->choices[0]->message->content;
        // echo Str::markdown($content);
        // echo '<img width="600px" src="data:image/jpeg;base64,' . $image->image . '" />';
        // exit();
        // $story = Story::first();
        // $content = $story->generated_story->choices[0]->message->content;
        // $gpt = OpenAI::chat()->create([
        //     'model' => 'gpt-4o-mini',
        //     'messages' => [
        //         [
        //             'role' => 'user',
        //             'content' => 'Generate a prompt to use for Dall-E 3, to generate an image in sci-fi 3D style, based on this story and return just the prompt: ' . $content
        //         ],
        //     ],
        // ]);
        // // dd($gpt->choices[0]->message->content);

        // // $content = "Once upon a time, there was a little boy named Timmy who loved playing with colorful building blocks. One day, he decided to build his tallest tower yet, carefully stacking red, blue, yellow, and green blocks. But as he piled them up, the tower wobbled and crashed down. Disappointed, Timmy remembered his mom’s words: “If it doesn’t work the first time, try again!” So he rebuilt with stable blocks, and soon the tower took shape. Just as it neared completion, Timmy’s cat, Misse, knocked it over. This time, Timmy laughed, inviting Misse to help. Together, they built an even higher, stronger tower, learning that teamwork makes everything more fun.";
        // $content = $gpt->choices[0]->message->content;
        // $response = OpenAI::images()->create([
        //     'model' => 'dall-e-3',
        //     'prompt' => $content,
        //     'n' => 1,
        //     'size' => '1024x1024',
        //     'response_format' => 'b64_json',
        // ]);
        // echo '<img width="600px" src="data:image/jpeg;base64,' . $response->data[0]->b64_json . '" />';
        // exit();
        // dd($response);
        return view('livewire.homepage');
    }

    public function generate()
    {
        $gpt = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'frequency_penalty' => 0.5,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Create a beautiful children\'s storytale based on the following description in a good looking markdown format with only the story header and the story itself, no other information:
' . $this->story . '

Reading time: ' . $this->length . ' minutes

Age group: ' . $this->age . ' years old

Language: ' . $this->language,
                ],
            ],
        ]);
        $uuid = Str::uuid();
        // $story = $gpt['choices'][0]['message']['content'];
        Story::create([
            'uuid' => $uuid,
            'story' => $this->story,
            'length' => $this->length,
            'age' => $this->age,
            'language' => $this->language,
            'generated_story' => $gpt,
            // 'model' => 'gpt-4o-mini',
            'ip_address' => request()->ip(),
        ]);

        $this->generate_image($uuid, 'cartoon');
        // $gptColor = OpenAI::chat()->create([
        //     'model' => 'gpt-4o-mini',
        //     'messages' => [
        //         [
        //             'role' => 'user',
        //             'content' => 'From this tale, generate me just a colour (#XXXXXX) that would fit the storyline:\n' . $story
        //         ],
        //     ],
        // ]);
        // $gptColorMsg = $gptColor['choices'][0]['message']['content'];
        // preg_match_all('/#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})\b/', $gptColorMsg, $matches);
        // $colorCode = $matches[0][0];
        // Story::where('uuid', $uuid)->update([
        //     'colour' => $colorCode,
        // ]);
        return redirect()->route('story', ['uuid' => $uuid]);
    }

    function generate_image($uuid, $style)
    {
        $story = Story::query()->where('uuid', $uuid)->first();
        $content = $story->generated_story->choices[0]->message->content;
        $gpt = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Generate a prompt to use for Dall-E 3, to generate an image in ' . $style . ' 3D style, based on this story and return just the prompt: ' . $content
                ],
            ],
        ]);
        $prompt = $gpt->choices[0]->message->content;

        $response = OpenAI::images()->create([
            'model' => 'dall-e-3',
            'prompt' => $prompt,
            'n' => 1,
            'size' => '1024x1024',
            'response_format' => 'b64_json',
        ]);

        return StoryImage::create([
            'story_id' => $story->id,
            'style' => $style,
            'prompt' => $prompt,
            'image' => $response->data[0]->b64_json,
        ]);
    }
}
