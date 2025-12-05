<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Genre</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: brightness(0) invert(1);
            /* pure white */
            opacity: 1;
            cursor: pointer;
        }

        input[type="date"] {
            color-scheme: dark;
            /* helps Firefox */
        }
    </style>


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

        <h1 class="text-4xl font-bold tracking-widest mb-8">New Genre</h1>

        <form action="{{ route('genres.store') }}" method="POST"
            class="space-y-8 bg-black p-8 rounded-lg border border-gray-700">
            @csrf

            <!-- Member -->
            <div>
                <label class="block mb-2 text-gray-300">Genre</label>
                <input type="text" name="name"
                    class="px-3 py-2 bg-black/60 border border-gray-700 text-gray-200 w-full
                   focus:outline-none focus:border-white transition-all tracking-widest">
            </div>

            <div class="flex justify-end">
                <a href="{{ route('genres.index') }}"
                    class="px-4 py-2 bg-gray-600 mr-4 hover:bg-gray-500 transition ease-in-out cursor-pointer">Cancel</a>
                <button
                    class="px-4 py-2 bg-indigo-600 cursor-pointer hover:bg-indigo-500 transition ease-in-out">Create</button>
            </div>
        </form>

    </div>

    @livewireScripts
</body>

</html>
