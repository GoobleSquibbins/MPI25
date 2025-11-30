<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowings</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-black text-gray-200 font-mono flex tracking-wide">

    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col ml-8 p-8">

        <!-- Header Section -->
        <div class="w-full border-b border-gray-700 pb-6 mb-8">
            <h1 class="text-4xl font-semibold uppercase tracking-widest">Borrowings Log</h1>
            <p class="text-gray-400 mt-2">Loan Records: Monitoring Unit Active</p>
        </div>

        <!-- Table Container -->
        <div class="w-full bg-black/40 backdrop-blur-sm border border-gray-700 p-6 rounded-lg scanlines">

            <table class="table-auto w-full border-collapse text-sm">
                <thead class="border-b border-gray-700 text-gray-300 uppercase tracking-widest text-xs">
                    <tr>
                        <th class="py-3 text-left">Member</th>
                        <th class="py-3 text-left">Staff</th>
                        <th class="py-3 text-left">Borrow Date</th>
                        <th class="py-3 text-left">Due Date</th>
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
                                        'borrowed' => 'text-blue-400', // YoRHa system blue
                                        'returned' => 'text-gray-200', // White-ish neutral
                                        'overdue' => 'text-red-400', // Alert red
                                        default => 'text-gray-400',
                                    };
                                @endphp

                                <span class="{{ $color }} font-semibold tracking-wider">
                                    {{ $bd->status }}
                                </span>
                            </td>

                            <td class="py-3">
                                <a href="{{ route('borrowings.edit', $bd->id) }}" class="text-blue-400 hover:text-blue-300 transition">
                                    Edit
                                </a>

                                <form action="{{ route('borrowings.destroy', $bd->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-400 hover:text-red-300 transition"
                                            onclick="return confirm('Delete this record?')">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
            <div class="mt-4">
            <a href="{{ route('borrowings.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition uppercase tracking-widest text-sm">
                Borrow a Book
            </a>
        </div>
    </div>

</body>

</html>
