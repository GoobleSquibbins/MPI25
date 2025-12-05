<div class="relative w-full">

    {{-- Search Box --}}
    <input type="text"
        wire:model.live.debounce.300ms="query"
        placeholder="Search books..."
        class="w-full px-3 py-2 bg-black border border-gray-700 text-gray-200  focus:outline-none focus:border-white transition ease-in-out">

    {{-- Dropdown --}}
    @if (!empty($results))
        <ul class="absolute bg-white text-black w-full mt-1  shadow-lg z-10">
            @foreach ($results as $book)
                <li wire:click="selectBook({{ $book->id }})"
                    class="px-3 py-2 hover:bg-gray-200 cursor-pointer">
                    {{ $book->name }} — <span class="text-xs">({{ $book->available_copies }} left)</span>
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Selected Books Chips --}}
    <div class="flex flex-wrap gap-2 mt-3">
        @foreach ($selectedBooks as $book)
            <div class="flex items-center bg-indigo-600 px-3 py-1 text-white text-sm">
                {{ $book['name'] }}
                <button wire:click="removeBook({{ $book['id'] }})"
                        class="ml-2 text-xs hover:text-gray-300">✕</button>
            </div>
        @endforeach
    </div>

    {{-- Hidden input for form --}}
    @foreach ($selectedBooks as $book)
        <input type="hidden" name="books[]" value="{{ $book['id'] }}">
    @endforeach

</div>
