<div class="w-full">

    <!-- Search -->
    <div class="mb-6 flex items-center">
        <input wire:model.debounce.300ms.live="search"
            type="text"
            placeholder="Search members..."
            class="px-4 py-2 bg-black/60 border border-gray-700 text-gray-200 w-[300px]
                   focus:outline-none focus:border-white transition-all tracking-widest">
    </div>

    <!-- Table Container -->
    <div class="w-full bg-black/40 backdrop-blur-sm border border-gray-700 p-6 rounded-lg">

        <table class="table-auto w-full border-collapse text-sm">
            <thead class="border-b border-gray-700 text-gray-300 uppercase tracking-widest text-xs">
                <tr>
                    <th class="py-3 text-left">Name</th>
                    <th class="py-3 text-left">Address</th>
                    <th class="py-3 text-left">Phone</th>
                    <th class="py-3 text-left">Email</th>
                    <th class="py-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-800">
                @foreach ($members as $md)
                    <tr class="hover:bg-white/5 transition">
                        <td class="py-3">{{ $md->name }}</td>
                        <td class="py-3">{{ $md->address }}</td>
                        <td class="py-3">{{ $md->phone }}</td>
                        <td class="py-3">{{ $md->email }}</td>
                        <td class="py-3">
                            <a href="#" class="text-blue-400 hover:text-blue-300 transition">Edit</a>
                            <a href="#" class="ml-3 text-red-400 hover:text-red-300 transition">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $members->links() }}
        </div>
    </div>
</div>