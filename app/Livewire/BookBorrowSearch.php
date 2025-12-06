<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;

class BookBorrowSearch extends Component
{
    public $query = '';
    public $results = [];

    // multiple books stored here
    public $selectedBooks = [];

    public function updatedQuery()
    {
        $this->results = Book::where('name', 'like', '%' . $this->query . '%')
            ->where('available_copies', '>', 0)
            ->limit(5)
            ->get();
    }

    public function selectBook($id)
    {
        // prevent duplicates
        if (isset($this->selectedBooks[$id])) {
            return;
        }

        $book = Book::find($id);

        if ($book) {
            $this->selectedBooks[$id] = [
                'id' => $book->id,
                'name' => $book->name,
            ];
        }

        // Clear search box
        $this->query = '';
        $this->results = [];

        // Emit to parent
        $this->dispatch('books-updated', array_keys($this->selectedBooks));
    }

    public function removeBook($id)
    {
        unset($this->selectedBooks[$id]);
        $this->dispatch('books-updated', array_keys($this->selectedBooks));
    }

    public function mount($selectedBookIds = [])
    {
        // For edit forms later
        foreach ($selectedBookIds as $id) {
            $book = Book::find($id);
            if ($book) {
                $this->selectedBooks[$id] = [
                    'id' => $book->id,
                    'name' => $book->name,
                ];
            }
        }
    }

    public function render()
    {
        return view('livewire.borrowings.book-borrow-search');
    }
}