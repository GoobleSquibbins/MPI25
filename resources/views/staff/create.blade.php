<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Staff</title>
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

        <h1 class="text-4xl font-bold tracking-widest mb-8">New Staff</h1>

        <form action="{{ route('staffs.store') }}" method="POST" class="space-y-8 bg-black p-8  border border-gray-700">
            @csrf
            <div>
                <label class="block mb-2 text-gray-300">Name</label>
                <input type="text" name="name"
                    class="px-3 py-2 bg-black/60 border border-gray-700 text-gray-200 w-full
                   focus:outline-none focus:border-white transition-all tracking-widest">
            </div>
            <div>
                <label class="block mb-2 text-gray-300">Role</label>
                <select name="role" id="role"
                    class="px-3 py-2 bg-black border border-gray-700 text-gray-200 w-full
           focus:outline-none focus:border-white transition-all tracking-widest">
                    @foreach ($roles as $r)
                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                    @endforeach
                </select>

            </div>
            <div>
                <label class="block mb-2 text-gray-300">Password</label>
                <input type="text" name="password"
                    class="px-3 py-2 bg-black/60 border border-gray-700 text-gray-200 w-full
                   focus:outline-none focus:border-white transition-all tracking-widest">
            </div>
            <div>
                <label class="block mb-2 text-gray-300">Confirm Password</label>
                <input type="text" name="password_conf"
                    class="px-3 py-2 bg-black/60 border border-gray-700 text-gray-200 w-full
                   focus:outline-none focus:border-white transition-all tracking-widest">
            </div>
            <div>
                <div class="flex justify-end">
                    <a href="{{ route('staffs.index') }}"
                        class="px-4 py-2 bg-gray-600 mr-4 hover:bg-gray-500 transition ease-in-out cursor-pointer">Cancel</a>
                    <button
                        class="px-4 py-2 bg-indigo-600 cursor-pointer hover:bg-indigo-500 transition ease-in-out">Create</button>
                </div>
            </div>
        </form>

    </div>

    @livewireScripts
</body>

</html>
