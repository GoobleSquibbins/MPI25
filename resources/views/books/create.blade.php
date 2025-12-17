<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
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

        <!-- Header -->
        <h1 class="text-4xl font-bold tracking-widest mb-8">Add New Book</h1>

        <!-- Form Container -->
        <form action="{{ route('books.store') }}" method="POST"
              class="space-y-8 bg-black p-8 border border-gray-700">
            @csrf

            <!-- Book Name -->
            <div>
                <label class="block mb-2 text-gray-300">Book Name</label>
                <input type="text" name="name" required
                       class="w-full px-3 py-2 bg-black border border-gray-600 focus:outline-none focus:border-white transition">
            </div>

            <!-- Publisher -->
             <div>
                <label class="block mb-2 text-gray-300">Publisher</label>
                @livewire('publisher-book-search')
            </div>

            <!-- Year -->
            <div>
                <label class="block mb-2 text-gray-300">Publication Year</label>
                <input type="number" name="year" min="1000" max="{{ date('Y') }}" required
                       class="w-full px-3 py-2 bg-black border border-gray-600 focus:outline-none focus:border-white transition">
            </div>

            <!-- Total Copies -->
            <div>
                <label class="block mb-2 text-gray-300">Total Copies</label>
                <input type="number" name="total_copies" min="1" required
                       class="w-full px-3 py-2 bg-black border border-gray-600 focus:outline-none focus:border-white transition">
            </div>

            <!-- Available Copies -->
            <div>
                <label class="block mb-2 text-gray-300">Available Copies</label>
                <input type="number" name="available_copies" min="0" required
                       class="w-full px-3 py-2 bg-black border border-gray-600 focus:outline-none focus:border-white transition">
            </div>

            <!-- Authors -->
            <div>
                <label class="block mb-2 text-gray-300">Authors</label>
                @livewire('author-book-search')
            </div>

            <!-- Genres -->
            <div>
                <label class="block mb-2 text-gray-300">Genres</label>
                @livewire('genre-book-search')
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <a href="{{ route('books.index') }}"
                   class="px-4 py-2 bg-gray-600 mr-4 hover:bg-gray-500 transition cursor-pointer">
                    Cancel
                </a>
                <button name="submit" type="submit"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 transition cursor-pointer">
                    Create Book
                </button>
            </div>

        </form>

    </div>

    @livewireScripts
</body>

</html>
