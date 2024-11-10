<div class="flex items-center justify-center h-auto bg-gradient-to-r from-gray-100 to-gray-300 flex-col">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mt-10">
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">AI Tale Generator</h1>
        <form class="space-y-4" wire:submit="generate">
            <div>
                <label for="story" class="block text-sm font-medium text-gray-600">Story Idea:</label>
                <textarea wire:model="story" id="story" name="story" rows="4" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"></textarea>
            </div>
            <div>
                <label for="age-group" class="block text-sm font-medium text-gray-600">Age Group:</label>
                <select id="age-group" wire:model="age" name="age" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2">
                    <option value="">Select Age Group</option>
                    <option value="0-3">0-3 years</option>
                    <option value="3-5">3-5 years</option>
                    <option value="6-8">6-8 years</option>
                    <option value="9-12">9-12 years</option>
                    <option value="13+">13 years and up</option>
                </select>
            </div>
            <!-- <div>
                <label for="style" class="block text-sm font-medium text-gray-600">Style:</label>
                <select id="style" name="style" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2">
                    <option value="">Select Style</option>
                    <option value="fantasy">Fantasy</option>
                    <option value="adventure">Adventure</option>
                    <option value="mystery">Mystery</option>
                    <option value="horror">Horror</option>
                </select>
            </div> -->
            <div>
                <label for="length" class="block text-sm font-medium text-gray-600">Length:</label>
                <select id="length" wire:model="length" name="length" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2">
                    <option value="">Select Length</option>
                    <option value="1-2">Short (1-2 minutes)</option>
                    <option value="3-5">Medium (3-5 minutes)</option>
                    <option value="5-10">Long (5-10 minutes)</option>
                </select>
            </div>
            <div>
                <label for="language" class="block text-sm font-medium text-gray-600">Language:</label>
                <select id="language" wire:model="language" name="language" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2">
                    <option value="">Select Language</option>
                    <option value="danish">Danish</option>
                    <option value="english">English</option>
                </select>
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-500 transition duration-200">Generate
                Tale</button>
        </form>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mt-5 mb-10">
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-2">Latest Stories</h1>
        @foreach($stories as $story)
            <div class="mb-2">
                <a href="{{ route('story', ['uuid' => $story->uuid]) }}"
                    class="block text-blue-600 font-semibold text-md hover:text-blue-500">{{ $story->generated_story_header_html }}</a>
                <p class="text-gray-600">{{ $story->created_at->locale('da_DK')->diffForHumans() }}</p>
            </div>
        @endforeach
    </div>
</div>
