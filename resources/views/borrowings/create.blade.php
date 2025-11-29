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
            <h1 class="text-4xl font-semibold uppercase tracking-widest">Add New Borrowing</h1>
            <p class="text-gray-400 mt-2">Create a new borrowing record</p>
        </div>

        <!-- Form Section -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <form action="{{ route('borrowings.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Member -->
                <div>
                    <label for="member_id" class="block text-sm font-medium text-gray-300">Member</label>
                    <select id="member_id" name="member_id" required
                            class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-white">
                        <option value="">Select Member</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Staff -->
                <div>
                    <label for="staff_id" class="block text-sm font-medium text-gray-300">Staff</label>
                    <select id="staff_id" name="staff_id" required
                            class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-white">
                        <option value="">Select Staff</option>
                        @foreach($staff as $staffMember)
                            <option value="{{ $staffMember->id }}">{{ $staffMember->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Borrow Date -->
                <div>
                    <label for="borrow_date" class="block text-sm font-medium text-gray-300">Borrow Date</label>
                    <input type="date" id="borrow_date" name="borrow_date" required value="{{ date('Y-m-d') }}"
                           class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-white">
                </div>

                <!-- Due Date -->
                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-300">Due Date</label>
                    <input type="date" id="due_date" name="due_date" required value="{{ date('Y-m-d', strtotime('+14 days')) }}"
                           class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-white">
                </div>

                <!-- Books -->
                <div>
                    <label for="books" class="block text-sm font-medium text-gray-300">Books</label>
                    <select id="books" name="books[]" multiple required
                            class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-white">
                        @foreach($books as $book)
                            <option value="{{ $book->id }}">{{ $book->name }} (Available: {{ $book->available_copies }})</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-sm text-gray-400">Hold Ctrl (or Cmd) to select multiple books</p>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <a href="{{ route('borrowings.index') }}" class="mr-4 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-500 transition duration-200">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 transition duration-200">Create Borrowing</button>
                </div>
            </form>
        </div>

</body>
