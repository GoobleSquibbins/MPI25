<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-black text-gray-200 font-mono flex tracking-wide">

    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col ml-8 p-8">

        <!-- Header Section -->
        <div class="w-full border-b border-gray-700 pb-6 mb-8">
            <h1 class="text-4xl font-semibold uppercase tracking-widest">Add New Book</h1>
            <p class="text-gray-400 mt-2">Create a new book entry in the archive</p>
        </div>

        <!-- Form Section -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <form action="{{ route('books.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Book Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300">Book Name</label>
                    <input type="text" id="name" name="name" required
                           class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-white">
                </div>

                <!-- Publisher -->
                <div>
                    <label for="publisher_id" class="block text-sm font-medium text-gray-300">Publisher</label>
                    <select id="publisher_id" name="publisher_id" required
                            class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-white">
                        <option value="">Select Publisher</option>
                        @foreach($publishers as $publisher)
                            <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Year -->
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-300">Publication Year</label>
                    <input type="number" id="year" name="year" required min="1000" max="{{ date('Y') }}"
                           class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-white">
                </div>

                <!-- Total Copies -->
                <div>
                    <label for="total_copies" class="block text-sm font-medium text-gray-300">Total Copies</label>
                    <input type="number" id="total_copies" name="total_copies" required min="1"
                           class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-white">
                </div>

                <!-- Available Copies -->
                <div>
                    <label for="available_copies" class="block text-sm font-medium text-gray-300">Available Copies</label>
                    <input type="number" id="available_copies" name="available_copies" required min="0"
                           class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-white">
                </div>

                <!-- Authors -->
                <div>
                    <label for="authors" class="block text-sm font-medium text-gray-300">Authors</label>
                    <select id="authors" name="authors[]" multiple
                            class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-white">
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-sm text-gray-400">Hold Ctrl (or Cmd) to select multiple authors</p>
                    <label for="new_authors" class="block text-sm font-medium text-gray-300 mt-4">Add New Authors</label>
                    <textarea id="new_authors" name="new_authors" rows="2"
                              placeholder="Enter new author names separated by commas (optional)"
                              class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-white"></textarea>
                    <p class="mt-1 text-sm text-gray-400">Enter new author names separated by commas. They will be created automatically.</p>
                </div>

                <!-- Genres -->
                <div>
                    <label for="genres" class="block text-sm font-medium text-gray-300">Genres</label>
                    <select id="genres" name="genres[]" multiple
                            class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-white">
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-sm text-gray-400">Hold Ctrl (or Cmd) to select multiple genres</p>
                    <label for="new_genres" class="block text-sm font-medium text-gray-300 mt-4">Add New Genres</label>
                    <textarea id="new_genres" name="new_genres" rows="2"
                              placeholder="Enter new genre names separated by commas (optional)"
                              class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-white"></textarea>
                    <p class="mt-1 text-sm text-gray-400">Enter new genre names separated by commas. They will be created automatically.</p>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <a href="{{ route('books.index') }}" class="mr-4 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-500 transition duration-200">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 transition duration-200">Create Book</button>
                </div>
            </form>
        </div>

</body>
</html>
