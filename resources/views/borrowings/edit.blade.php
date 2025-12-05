<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Borrowing</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-black text-gray-200 font-mono flex">
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-900/40 border border-red-700 text-red-300 text-sm">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @include('layouts.sidebar')

    <div class="flex-1 p-10">

        <h1 class="text-4xl font-bold tracking-widest mb-8">Edit Borrowing</h1>

        <form action="{{ route('borrowings.update', $borrowing->id) }}" method="POST"
            class="space-y-8 bg-black p-8 border border-gray-700">
            @csrf
            @method('PUT')

            {{-- Member --}}
            <div>
                <label class="block mb-2 text-gray-300">Member</label>
                @livewire('member-borrow-search', ['selectedMemberId' => $borrowing->member_id])
            </div>

            {{-- Book --}}
            <div>
                <label class="block mb-2 text-gray-300">Book</label>

                @php
                    $selectedBookIds = $borrowing->details->pluck('book_id')->toArray();
                @endphp

                @livewire('book-borrow-search', ['selectedBookIds' => $selectedBookIds])
            </div>

            {{-- Dates --}}
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-gray-300">Borrow Date</label>
                    <input type="date" name="borrow_date" value="{{ $borrowing->borrow_date }}"
                        class="w-full px-3 py-2 bg-black border border-gray-600 focus:outline-none focus:border-white transition ease-in-out">
                </div>

                <div>
                    <label class="block mb-2 text-gray-300">Due Date</label>
                    <input type="date" name="due_date" value="{{ $borrowing->due_date }}"
                        class="w-full px-3 py-2 bg-black border border-gray-600 focus:outline-none focus:border-white transition ease-in-out">
                </div>

                <div>
                    <label class="block mb-2 text-gray-300">Return Date</label>
                    <input type="date" name="return_date" value="{{ $borrowing->return_date }}"
                        class="w-full px-3 py-2 bg-black border border-gray-600 focus:outline-none focus:border-white transition ease-in-out">
                </div>
            </div>

            {{-- Status --}}
            <div>
                <label class="block mb-2 text-gray-300">Status</label>
                <select name="status"
                    class="w-full px-3 py-2 bg-black border relative inline-block border-gray-600 focus:outline-none focus:border-white transition ease-in-out">
                    <option value="borrowed" {{ $borrowing->status === 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                    <option value="returned" {{ $borrowing->status === 'returned' ? 'selected' : '' }}>Returned</option>
                    <option value="overdue" {{ $borrowing->status === 'overdue' ? 'selected' : '' }}>Overdue</option>
                </select>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('borrowings.index') }}" class="px-4 py-2 bg-gray-600 mr-4">Cancel</a>

                <button class="px-4 py-2 bg-indigo-600">Update</button>
            </div>

        </form>
    </div>

    @livewireScripts
</body>

</html>
