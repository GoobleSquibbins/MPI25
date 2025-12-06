<?php

namespace App\Livewire;

use App\Models\Author;
use App\Models\Member;
use App\Models\Publisher;
use Livewire\Component;

class PublisherBookSearch extends Component
{
    public $query = '';

    public $results = [];

    public $selectedPublisher = null;

    public function updatedQuery()
    {
        $this->results = Publisher::where('name', 'like', '%'.$this->query.'%')
            ->limit(5)
            ->get();
    }

    public function selectPublisher($publisherId)
{
    $publisher = Publisher::find($publisherId);

    $this->selectedPublisher = $publisher;
    $this->selectedPublisherId = $publisherId;

    $this->query = $publisher->name;
    $this->results = [];

    $this->dispatch('publisher-selected', publisherId: $publisherId);
}


    public $selectedPublisherId = null;

    public function mount($selectedPublisherId = null)
    {
        if ($selectedPublisherId) {
            $this->selectedPublisherId = $selectedPublisherId;
            $this->selectedPublisher = Publisher::find($selectedPublisherId);
            $this->query = $this->selectedPublisher->name ?? '';

            $this->dispatch('publisher-selected', publisherId: $selectedPublisherId);
        }
    }

    public function render()
    {
        return view('livewire.books.publisher-book-search');
    }
}
