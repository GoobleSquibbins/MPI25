<div class="relative">
    <input type="text" name="publisher-search" wire:model.live="query" placeholder="Search publisher..."
           dusk="publisher-search"
           class="w-full px-3 py-2 bg-black border border-gray-600 text-white focus:outline-none focus:border-white transition ease-in-out">

    @if (!empty($results))
        <div class="absolute z-10 w-full bg-white text-black shadow-lg mt-1">
            @foreach ($results as $publisher)
                <div wire:click="selectPublisher({{ $publisher->id }})"
                     name="publisher-result-{{ $publisher->id }}"
                     class="px-3 py-2 cursor-pointer hover:bg-gray-200">
                    {{ $publisher->name }}
                </div>
            @endforeach
        </div>
    @endif

    @if ($selectedPublisher)
        <input type="hidden" name="publisher_id" value="{{ $selectedPublisher->id }}">
    @endif
</div>
