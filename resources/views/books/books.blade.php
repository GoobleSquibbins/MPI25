<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
@livewireScripts

<body class="min-h-screen bg-black text-gray-200 font-mono flex tracking-wide">

    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col ml-8 p-8">

        <!-- Header Section -->
        <div class="w-full border-b border-gray-700 pb-6 mb-8">
            <h1 class="text-4xl font-semibold uppercase tracking-widest">Books Archive</h1>
            <p class="text-gray-400 mt-2">Data Registry: Printed Literature Unit</p>
        </div>

        <!-- Table Container -->
        @livewire('book-table')


        <!-- Add Book Button -->
        <div class="mt-4">
            <a href="{{ route('books.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition uppercase tracking-widest text-sm">
                Add Book
            </a>
        </div>
    </div>

</body>

</html>
