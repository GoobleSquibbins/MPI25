<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Genre;

class GenreBookSearch extends Component
{
    public $query = '';
    public $results = [];

    // multiple genre stored here
    public $selectedGenres = [];

    public function updatedQuery()
    {
        $this->results = Genre::where('name', 'like', '%'.$this->query.'%')
            ->limit(5)
            ->get();
    }

    public function selectGenre($id)
    {
        // prevent duplicates
        if (isset($this->selectedGenres[$id])) {
            return;
        }

        $genre = Genre::find($id);

        if ($genre) {
            $this->selectedGenres[$id] = [
                'id' => $genre->id,
                'name' => $genre->name,
            ];
        }

        // Clear search box
        $this->query = '';
        $this->results = [];

        // Emit to parent
        $this->dispatch('genre-updated', array_keys($this->selectedGenres));
    }

    public function removeGenre($id)
    {
        unset($this->selectedGenres[$id]);
        $this->dispatch('genre-updated', array_keys($this->selectedGenres));
    }

    public function mount($selectedGenreIds = [])
    {
        // For edit forms later
        foreach ($selectedGenreIds as $id) {
            $genre = Genre::find($id);
            if ($genre) {
                $this->selectedGenres[$id] = [
                    'id' => $genre->id,
                    'name' => $genre->name,
                ];
            }
        }
    }

    public function render()
    {
        return view('livewire.books.genre-book-search');
    }
}
