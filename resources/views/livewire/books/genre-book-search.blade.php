<div class="relative w-full">

    {{-- Search Box --}}
    <input type="text"
        wire:model.live.debounce.300ms="query"
        placeholder="Search genre..."
        name="genre-search"
        class="w-full px-3 py-2 bg-black border border-gray-700 text-gray-200  focus:outline-none focus:border-white transition ease-in-out">

    {{-- Dropdown --}}
    @if (!empty($results))
        <ul class="absolute bg-white text-black w-full mt-1  shadow-lg z-10">
            @foreach ($results as $genre)
                <li wire:click="selectGenre({{ $genre->id }})"
                    name="genre-result-{{ $genre->id }}"
                    class="px-3 py-2 hover:bg-gray-200 cursor-pointer">
                    {{ $genre->name }}
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Selected Genre Chips --}}
    <div class="flex flex-wrap gap-2 mt-3">
        @foreach ($selectedGenres as $genre)
            <div class="flex items-center bg-indigo-600 px-3 py-1 text-white text-sm">
                {{ $genre['name'] }}
                <button wire:click="removeGenre({{ $genre['id'] }})"
                        class="ml-2 text-xs hover:text-gray-300">✕</button>
            </div>
        @endforeach
    </div>

    {{-- Hidden input for form --}}
    @foreach ($selectedGenres as $genre)
        <input type="hidden" name="genres[]" value="{{ $genre['id'] }}">
    @endforeach

</div>
