<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Borrowing</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-black text-gray-200 font-mono flex tracking-wide">

    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col ml-8 p-8">

        <!-- Header Section -->
        <div class="w-full border-b border-gray-700 pb-6 mb-8">
            <h1 class="text-4xl font-semibold uppercase tracking-widest">Edit Borrowing</h1>
            <p class="text-gray-400 mt-2">Modify loan record</p>
        </div>

        <!-- Form Container -->
        <div class="w-full bg-black/40 backdrop-blur-sm border border-gray-700 p-6 rounded-lg">

            <form action="{{ route('borrowings.update', $borrowing->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Member -->
                <div class="mb-4">
                    <label class="block text-sm uppercase tracking-widest mb-1">Member</label>
                    <select name="member_id"
                            class="w-full bg-gray-900 border border-gray-700 p-2 rounded text-gray-200">
                        @foreach ($members as $m)
                            <option value="{{ $m->id }}"
                                @if ($borrowing->member_id == $m->id) selected @endif>
                                {{ $m->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Staff -->
                <div class="mb-4">
                    <label class="block text-sm uppercase tracking-widest mb-1">Staff</label>
                    <select name="staff_id"
                            class="w-full bg-gray-900 border border-gray-700 p-2 rounded text-gray-200">
                        @foreach ($staffs as $s)
                            <option value="{{ $s->id }}"
                                @if ($borrowing->staff_id == $s->id) selected @endif>
                                {{ $s->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Borrow Date -->
                <div class="mb-4">
                    <label class="block text-sm uppercase tracking-widest mb-1">Borrow Date</label>
                    <input type="date" name="borrow_date"
                        value="{{ $borrowing->borrow_date }}"
                        class="w-full bg-gray-900 border border-gray-700 p-2 rounded text-gray-200">
                </div>

                <!-- Due Date -->
                <div class="mb-4">
                    <label class="block text-sm uppercase tracking-widest mb-1">Due Date</label>
                    <input type="date" name="due_date"
                        value="{{ $borrowing->due_date }}"
                        class="w-full bg-gray-900 border border-gray-700 p-2 rounded text-gray-200">
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <label class="block text-sm uppercase tracking-widest mb-1">Status</label>
                    <select name="status"
                            class="w-full bg-gray-900 border border-gray-700 p-2 rounded text-gray-200">
                        <option value="borrowed" @if($borrowing->status == 'borrowed') selected @endif>Borrowed</option>
                        <option value="returned" @if($borrowing->status == 'returned') selected @endif>Returned</option>
                        <option value="overdue" @if($borrowing->status == 'overdue') selected @endif>Overdue</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition uppercase tracking-widest text-sm">
                        Update Borrowing
                    </button>

                    <a href="{{ route('borrowings.index') }}"
                        class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded transition uppercase tracking-widest text-sm">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>

</body>

</html>
