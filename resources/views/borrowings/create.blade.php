<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Borrowing</title>
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

        <h1 class="text-4xl font-bold tracking-widest mb-8">New Borrowing</h1>

        <form action="{{ route('borrowings.store') }}" method="POST"
            class="space-y-8 bg-black p-8 rounded-lg border border-gray-700">
            @csrf

            <!-- Member -->
            <div>
                <label class="block mb-2 text-gray-300">Member</label>
                @livewire('member-borrow-search')
            </div>

            <!-- Book -->
            <div>
                <label class="block mb-2 text-gray-300">Book</label>
                @livewire('book-borrow-search')
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-gray-300">Borrow Date</label>
                    <input type="date" name="borrow_date" required
                        value="{{ now()->timezone('Asia/Jakarta')->format('Y-m-d') }}"
                        class="w-full px-3 py-2 bg-black focus:outline-none focus:border-white border border-gray-600 transition ease-in-out">
                </div>

                <div>
                    <label class="block mb-2 text-gray-300">Due Date</label>
                    <input type="date" name="due_date" required
                        value="{{ now()->timezone('Asia/Jakarta')->addDays(7)->format('Y-m-d') }}"
                        class="w-full px-3 py-2 bg-black focus:outline-none focus:border-white border border-gray-600">
                </div>
            </div>


            <div class="flex justify-end">
                <a href="{{ route('borrowings.index') }}"
                    class="px-4 py-2 bg-gray-600 mr-4 hover:bg-gray-500 transition ease-in-out cursor-pointer">Cancel</a>
                <button
                    class="px-4 py-2 bg-indigo-600 cursor-pointer hover:bg-indigo-500 transition ease-in-out">Create</button>
            </div>
        </form>

    </div>

    @livewireScripts
</body>

</html>
