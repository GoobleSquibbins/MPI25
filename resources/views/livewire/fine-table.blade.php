<div class="w-full">


    <div class="mb-6 flex items-center gap-4">

        <!-- Search Box -->
        <div class="relative">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="SEARCH FOR MEMBER..."
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
    </div>

    <!-- Table Container -->
    <div class="w-full bg-black/40 backdrop-blur-sm border border-gray-700 p-6">

        <table class="table-auto w-full border-collapse text-sm">
            <thead class="border-b border-gray-700 text-gray-300 uppercase tracking-widest text-xs">
                <tr>
                    <th class="py-3 text-left">Borrower</th>
                    <th class="py-3 text-left">Amount</th>
                    <th class="py-3 text-left">Status</th>
                    <th class="py-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-800">
                @foreach ($fines as $f)
                    <tr class="hover:bg-white/5 transition">
                        <td class="py-3">{{ $f->borrow->member->name }}</td>
                        <td class="py-3">{{ $f->amount }}</td>
                        <td class="py-3">{{ $f->status }}</td>
                        <td>
                            @if ($f->status === 'pending')
                                <a href="{{ route('fines.pay', $f->id) }}"
                                    class="text-blue-400 hover:text-blue-300 transition">Pay</a>

                                <a href="{{ route('fines.waive', $f->id) }}"
                                    class="ml-3 text-red-400 hover:text-red-300 transition">Waive</a>
                            @elseif ($f->status === 'paid')
                                <span >-</span>
                            @elseif ($f->status === 'waived')
                                <span >-</span>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $fines->links() }}
        </div>
    </div>
</div>
