<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-black text-gray-200 font-mono flex items-center justify-center">

    <div class="w-full max-w-sm border border-gray-600 p-8 bg-black bg-opacity-80 shadow-[0_0_20px_rgba(255,255,255,0.1)]">

        <h1 class="text-center text-[16px] mb-6 tracking-widest">LIBRARY MANAGEMENT SYSTEM</h1>

        @if ($errors->any())
        <div class="mb-4 border border-red-500 text-red-400 p-3 text-sm">
            @foreach ($errors->all() as $error)
            <p>• {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form action="{{ route('authenticate') }}" method="POST" class="space-y-5">
            @csrf

            <div class="flex flex-col">
                <label class="text-xs tracking-wide mb-1">NAME</label>
                <input type="text" name="name"
                    class="bg-black border border-gray-600 focus:border-gray-300 p-2 text-gray-200 outline-none tracking-wide">
            </div>

            <div class="flex flex-col">
                <label class="text-xs tracking-wide mb-1">PASSWORD</label>
                <input type="password" name="password"
                    class="bg-black border border-gray-600 focus:border-gray-300 p-2 text-gray-200 outline-none tracking-wide">
            </div>

            <button type="submit"
                class="w-full border border-gray-400 py-2 tracking-widest hover:bg-gray-200 hover:text-black transition hover:cursor-pointer">
                LOGIN
            </button>
        </form>

        <p class="text-center text-[10px] text-gray-500 mt-8 tracking-widest">YoRHa ARCHIVE SECURITY PROTOCOL v3.1</p>
        <p class="text-center text-[7px] text-gray-500 mt-[5px] tracking-widest">FOR THE GLORY OF MANKIND</p>

    </div>

</body>

</html>
