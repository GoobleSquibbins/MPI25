<?php

namespace App\Livewire;

use App\Models\Author;
use App\Models\Genre;
use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class AuthorTable extends Component
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
        $authors = Author::query()
            ->where('name', 'like', "%{$this->search}%")
            ->paginate(10);

        return view('livewire.authors.author-table', [
            'authors' => $authors,
        ]);
    }
}
