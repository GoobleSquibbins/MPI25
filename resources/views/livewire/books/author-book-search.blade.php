<div class="relative w-full">

    {{-- Dropdown --}}
    <select
        name="author-select"
        wire:change="selectAuthor($event.target.value)"
        class="w-full px-3 py-2 bg-black border border-gray-700 text-gray-200 focus:outline-none focus:border-white transition ease-in-out"
    >
        <option value="">Select Author...</option>
        @foreach(\App\Models\Author::all() as $author)
            <option value="{{ $author->id }}">{{ $author->name }}</option>
        @endforeach
    </select>

    {{-- Selected Authors Chips --}}
    <div class="flex flex-wrap gap-2 mt-3">
        @foreach ($selectedAuthors as $author)
            <div class="flex items-center bg-indigo-600 px-3 py-1 text-white text-sm">
                {{ $author['name'] }}
                <button wire:click="removeAuthor({{ $author['id'] }})"
                        class="ml-2 text-xs hover:text-gray-300">✕</button>
            </div>
        @endforeach
    </div>

    {{-- Hidden input for form --}}
    @foreach ($selectedAuthors as $author)
        <input type="hidden" name="authors[]" value="{{ $author['id'] }}">
    @endforeach

</div>
