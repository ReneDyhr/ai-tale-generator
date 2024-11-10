<div class="flex items-center justify-center bg-gradient-to-r from-gray-100 to-gray-300 h-auto">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-xl">
        <a href="{{ route('homepage') }}"
            class="inline-block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Back</a>
        <img width="600px" src="data:image/jpeg;base64,{{$story->images()->first()->image}}" />
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-2 mt-2">
            {{$story->generated_story_header_html}}
        </h1>
        {!! Str::markdown($story->generated_story_html) !!}
    </div>
</div>
