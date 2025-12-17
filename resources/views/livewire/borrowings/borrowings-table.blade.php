<div class="w-full">

    <div class="mb-6">
        <a href="{{ route('borrowings.create') }}"
            id="borrow-button"
            class="inline-block w-[350px] text-center
               bg-white hover:bg-blue-600
               border border-black
               text-black font-semibold
               hover:text-white text-[16px]
               px-[30px] py-[7px]
               tracking-widest uppercase text-xs
               transition
               shadow-md hover:shadow-lg">
            + Borrow
        </a>
    </div>


    <!-- Search -->
    <div class="mb-6 flex items-center gap-4">

        <!-- Search Box -->
        <div class="relative">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="SEARCH MEMBER..."
                class="px-4 py-2 w-[350px]
                       bg-black/40 border border-gray-700 text-gray-200
                       tracking-widest uppercase text-xs
                       focus:outline-none focus:border-white transition-all
                       pr-10">

            <!-- Search Icon -->
            <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1 0 6.65 6.65a7.5 7.5 0 0 0 10 10Z" />
                </svg>
            </div>
        </div>

        <!-- Sort Dropdown -->
        <div class="relative inline-block">
            <select wire:model.live="sort"
                class="appearance-none pl-3 pr-10 py-2
               bg-black text-white
               border border-gray-700
               tracking-widest uppercase text-xs
               focus:outline-none focus:border-white
               transition-all w-48">

                <option value="borrow_date_desc">Borrow Date ↓</option>
                <option value="borrow_date_asc">Borrow Date ↑</option>
                <option value="due_date_desc">Due Date ↓</option>
                <option value="due_date_asc">Due Date ↑</option>
                <option value="returned">Returned</option>
                <option value="borrowed">Borrowed</option>
                <option value="overdue">Overdue</option>
            </select>

            <!-- Chevron -->
            <svg class="pointer-events-none w-4 h-4 text-white absolute right-3 top-1/2 -translate-y-1/2" fill="none"
                stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
            </svg>
        </div>



    </div>


    <div class="w-full bg-black/40 backdrop-blur-sm border border-gray-700 p-6 scanlines">

        <table class="table-auto w-full border-collapse text-sm">
            <thead class="border-b border-gray-700 text-gray-300 uppercase tracking-widest text-xs">
                <tr>
                    <th class="py-3 text-left">
                        Member
                    </th>
                    <th class="py-3 text-left">Staff
                    </th>
                    <th class="py-3 text-left">
                        Borrow Date</th>
                    <th class="py-3 text-left">Due
                        Date</th>
                    <th class="py-3 text-left">Status</th>
                    <th class="py-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-800">
                @foreach ($borrowing_data as $bd)
                    <tr class="hover:bg-white/5 transition">
                        <td class="py-3">{{ $bd->member->name }}</td>
                        <td class="py-3">{{ $bd->staff->name }}</td>
                        <td class="py-3">{{ $bd->borrow_date }}</td>
                        <td class="py-3">{{ $bd->due_date }}</td>
                        <td class="py-3">
                            @php
                                $color = match ($bd->status) {
                                    'borrowed' => 'text-blue-400',
                                    'returned' => 'text-gray-200',
                                    'overdue' => 'text-red-400',
                                    default => 'text-gray-400',
                                };
                            @endphp
                            <span class="{{ $color }} font-semibold tracking-wider">
                                {{ $bd->status }}
                            </span>
                        </td>

                        <td class="py-3">
                            <a href="{{ route('borrowings.edit', $bd->id) }}"
                                class="text-blue-400 hover:text-blue-300 transition">Edit</a>
                            <a href="{{ route('borrowings.delete', $bd->id) }}"
                                class="ml-3 text-red-400 hover:text-red-300 transition">Delete</a>
                            @if ($bd->status != 'returned')
                                <a href="{{ route('borrowings.bookBack', $bd->id) }}" class="ml-3 text-green-400 hover:text-green-300 transition">Return</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $borrowing_data->links() }}
        </div>

    </div>
</div>
