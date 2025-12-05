<?php

namespace App\Livewire;

use App\Models\Genre;
use App\Models\Member;
use App\Models\Publisher;
use Livewire\Component;
use Livewire\WithPagination;

class PublisherTable extends Component
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
        $publishers = Publisher::query()
            ->where('name', 'like', "%{$this->search}%")
            ->paginate(10);

        return view('livewire.publishers.publisher-table', [
            'publishers_data' => $publishers,
        ]);
    }
}
