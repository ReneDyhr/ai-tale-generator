<div class="flex items-center justify-center h-screen bg-gradient-to-r from-gray-100 to-gray-300 h-auto">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-xl">
        <img width="600px" src="data:image/jpeg;base64,{{$story->images()->first()->image}}" />
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-2 mt-2">
            {{$story->generated_story_header_html}}
        </h1>
        {!! Str::markdown($story->generated_story_html) !!}
    </div>
</div>
