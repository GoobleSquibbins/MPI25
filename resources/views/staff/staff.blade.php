<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-black text-gray-200 font-mono flex tracking-wide">

    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col ml-8 p-8">

        <!-- Header Section -->
        <div class="w-full border-b border-gray-700 pb-6 mb-8">
            <h1 class="text-4xl font-semibold uppercase tracking-widest">Staff Management</h1>
            <p class="text-gray-400 mt-2">Data Registry: Staff Personnel Unit</p>
        </div>

        <!-- Table Container -->
        <div class="w-full bg-black/40 backdrop-blur-sm border border-gray-700 p-6 rounded-lg">

            <table class="table-auto w-full border-collapse text-sm">
                <thead class="border-b border-gray-700 text-gray-300 uppercase tracking-widest text-xs">
                    <tr>
                        <th class="py-3 text-left">Name</th>
                        <th class="py-3 text-left">Role</th>
                        <th class="py-3 text-left">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-800">
                    @foreach ($staff_data as $staff)
                        <tr class="hover:bg-white/5 transition">
                            <td class="py-3">{{ $staff->name }}</td>
                            <td class="py-3">{{ $staff->role->name }}</td>
                            <td class="py-3">
                                <a href="#" class="text-blue-400 hover:text-blue-300 transition">Edit</a>
                                <a href="#" class="ml-3 text-red-400 hover:text-red-300 transition">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

</body>
</html>
