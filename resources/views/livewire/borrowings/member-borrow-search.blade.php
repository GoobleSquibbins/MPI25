<div class="relative">
    <input
        type="text"
        wire:model.live="query"
        placeholder="Search member..."
        class="w-full px-3 py-2 bg-black border border-gray-600 text-white focus:outline-none focus:border-white transition ease-in-out"
    >

    @if(!empty($results))
        <div class="absolute z-10 w-full bg-white text-black shadow-lg mt-1">
            @foreach($results as $member)
                <div
                    wire:click="selectMember({{ $member->id }})"
                    class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                >
                    {{ $member->name }}
                </div>
            @endforeach
        </div>
    @endif

    @if($selectedMember)
        <input type="hidden" name="member_id" value="{{ $selectedMember->id }}">
    @endif
</div>
