<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Author;

class AuthorBookSearch extends Component
{
    public $query = '';
    public $results = [];

    // multiple authors stored here
    public $selectedAuthors = [];

    public function updatedQuery()
    {
        $this->results = Author::where('name', 'like', '%' . $this->query . '%')
            ->limit(5)
            ->get();
    }

    public function selectAuthor($id)
    {
        // prevent duplicates
        if (isset($this->selectedAuthors[$id])) {
            return;
        }

        $author = Author::find($id);

        if ($author) {
            $this->selectedAuthors[$id] = [
                'id' => $author->id,
                'name' => $author->name,
            ];
        }

        // Clear search box
        $this->query = '';
        $this->results = [];

        // Emit to parent
        $this->dispatch('authors-updated', array_keys($this->selectedAuthors));
    }

    public function removeAuthor($id)
    {
        unset($this->selectedAuthors[$id]);
        $this->dispatch('authors-updated', array_keys($this->selectedAuthors));
    }

    public function mount($selectedAuthorIds = [])
    {
        // For edit forms later
        foreach ($selectedAuthorIds as $id) {
            $author = Author::find($id);
            if ($author) {
                $this->selectedAuthors[$id] = [
                    'id' => $author->id,
                    'name' => $author->name,
                ];
            }
        }
    }

    public function render()
    {
        return view('livewire.books.author-book-search');
    }
}
