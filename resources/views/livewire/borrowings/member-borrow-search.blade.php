<div class="relative">
    <select
        name="member_id"
        wire:change="selectMember($event.target.value)"
        class="w-full px-3 py-2 bg-black border border-gray-600 text-white focus:outline-none focus:border-white transition ease-in-out"
    >
        <option value="">Select Member</option>
        @foreach(\App\Models\Member::all() as $member)
            <option value="{{ $member->id }}" {{ $selectedMember && $selectedMember->id == $member->id ? 'selected' : '' }}>
                {{ $member->name }}
            </option>
        @endforeach
    </select>
</div>
