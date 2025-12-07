<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\Staff;
use Livewire\Component;
use Livewire\WithPagination;

class StaffTable extends Component
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
        $staffs = Staff::query()
            ->where('name', 'like', "%{$this->search}%")
            ->paginate(10);

        return view('livewire.staffs.staff-table', [
            'staffs' => $staffs,
        ]);
    }
}
