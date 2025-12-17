<div class="relative w-full">

    {{-- Dropdown --}}
    <select
        wire:change="selectBook($event.target.value)"
        name="book-select"
        class="w-full px-3 py-2 bg-black border border-gray-700 text-gray-200 focus:outline-none focus:border-white transition ease-in-out"
    >
        <option value="">Select Book...</option>
        @foreach(\App\Models\Book::where('available_copies', '>', 0)->get() as $book)
            <option value="{{ $book->id }}">{{ $book->name }} ({{ $book->available_copies }} left)</option>
        @endforeach
    </select>

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
