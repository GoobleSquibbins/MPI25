<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publisher</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
@livewireScripts


<body class="min-h-screen bg-black text-gray-200 font-mono flex tracking-wide">

    @include('layouts.sidebar')

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-900/40 border border-red-700 text-red-300 text-sm">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex-1 flex flex-col ml-8 p-8">
        <!-- Header Section -->
        <div class="w-full border-b border-gray-700 pb-6 mb-8">
            <h1 class="text-4xl font-semibold uppercase tracking-widest">Publisher List</h1>
            <p class="text-gray-400 mt-2">Loan Records: Monitoring Unit Active</p>
        </div>

        @livewire('publisher-table')

    </div>

</body>

</html>
