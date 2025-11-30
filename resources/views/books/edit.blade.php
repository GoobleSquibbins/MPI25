<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-black text-gray-200 font-mono flex tracking-wide">

    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col ml-8 p-8">

        <!-- Header -->
        <div class="w-full border-b border-gray-700 pb-6 mb-8">
            <h1 class="text-4xl font-semibold uppercase tracking-widest">Edit Book</h1>
            <p class="text-gray-400 mt-2">Modify existing book record</p>
        </div>

        <!-- Form Container -->
        <div class="w-full bg-black/40 backdrop-blur-sm border border-gray-700 p-6 rounded-lg">

            <form action="{{ route('books.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Title -->
                <div class="mb-4">
                    <label class="block text-sm uppercase tracking-widest mb-1">Title</label>
                    <input type="text" name="name"
                        value="{{ old('name', $book->name) }}"
                        class="w-full bg-gray-900 border border-gray-700 p-2 rounded text-gray-200">
                </div>

                <!-- Genres (Multiple Select) -->
                <div class="mb-4">
                    <label class="block text-sm uppercase tracking-widest mb-1">Genres</label>
                    <select name="genres[]" multiple
                        class="w-full bg-gray-900 border border-gray-700 p-2 rounded text-gray-200 h-32">
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}"
                                @if($book->genres->pluck('id')->contains($genre->id)) selected @endif>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold CTRL to select multiple.</p>
                </div>

                <!-- Authors (Multiple Select) -->
                <div class="mb-4">
                    <label class="block text-sm uppercase tracking-widest mb-1">Authors</label>
                    <select name="authors[]" multiple
                        class="w-full bg-gray-900 border border-gray-700 p-2 rounded text-gray-200 h-32">
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}"
                                @if($book->authors->pluck('id')->contains($author->id)) selected @endif>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Publisher -->
                <div class="mb-4">
                    <label class="block text-sm uppercase tracking-widest mb-1">Publisher</label>
                    <select name="publisher_id"
                        class="w-full bg-gray-900 border border-gray-700 p-2 rounded text-gray-200">
                        @foreach ($publishers as $publisher)
                            <option value="{{ $publisher->id }}"
                                @if($book->publisher_id == $publisher->id) selected @endif>
                                {{ $publisher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Year -->
                <div class="mb-4">
                    <label class="block text-sm uppercase tracking-widest mb-1">Year</label>
                    <input type="number" name="year"
                        value="{{ old('year', $book->year) }}"
                        class="w-full bg-gray-900 border border-gray-700 p-2 rounded text-gray-200">
                </div>

                <!-- Copies -->
                <div class="mb-6">
                    <label class="block text-sm uppercase tracking-widest mb-1">Available Copies</label>
                    <input type="number" name="available_copies"
                        value="{{ old('available_copies', $book->available_copies) }}"
                        class="w-full bg-gray-900 border border-gray-700 p-2 rounded text-gray-200">
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition uppercase tracking-widest text-sm">
                        Update Book
                    </button>

                    <a href="{{ route('books.index') }}"
                        class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded transition uppercase tracking-widest text-sm">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</body>
</html>
