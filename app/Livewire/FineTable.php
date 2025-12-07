<?php

namespace App\Livewire;

use App\Models\Fine;
use Livewire\Component;
use Livewire\WithPagination;

class FineTable extends Component
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
        $fines = Fine::query()
            ->where(function ($q) {
                $q->whereHas('borrow.member', function ($m) {
                    $m->where('name', 'like', "%{$this->search}%");
                })
                    ->orWhere('status', 'like', "%{$this->search}%");
            })
            ->orderBy('status', 'asc')  // <── sortingnya disini, Onii-chan~
            ->paginate(10);

        return view('livewire.fine-table', [
            'fines' => $fines,
        ]);
    }
}
