<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class BookTable extends Component
{
    use WithPagination;

    public $search = '';

    public $sortField = 'name';

    public $sortDirection = 'asc';

    protected $queryString = ['search', 'sortField', 'sortDirection'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = ($this->sortDirection === 'asc') ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $books = Book::with(['genres', 'authors'])
            ->where('available_copies', '>', 0)
            ->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhereHas('authors', fn ($qa) => $qa->where('name', 'like', "%{$this->search}%")
                    )
                    ->orWhereHas('genres', fn ($qg) => $qg->where('name', 'like', "%{$this->search}%")
                    );
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.book-table', [
            'books' => $books,
        ]);
    }
}
