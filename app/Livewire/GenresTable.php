<?php

namespace App\Livewire;

use App\Models\Genre;
use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class GenresTable extends Component
{
    use WithPagination;

    public $search = '';

    // Reset page on search so results don’t glitch out
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $genres = Genre::query()
            ->where('name', 'like', "%{$this->search}%")
            ->paginate(10);

        return view('livewire.genres.genres-table', [
            'genres_data' => $genres,
        ]);
    }
}
