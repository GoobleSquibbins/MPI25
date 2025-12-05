<?php

namespace App\Livewire;

use App\Models\Borrowing;
use Livewire\Component;
use Livewire\WithPagination;

class BorrowingsTable extends Component
{
    use WithPagination;

    public $search = '';

    // Main sort selector
    public $sort = 'borrow_date_desc';

    // Keep these in URL
    protected $updatesQueryString = ['search', 'sort'];

    // Reset pagination on search change
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Reset pagination on sort change
    public function updatedSort()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Borrowing::query()
            ->select('borrowings.*')
            ->join('members', 'members.id', '=', 'borrowings.member_id')
            ->with('member')

            // Search by member or item
            ->when($this->search, function ($q) {
                $q->where('members.name', 'like', '%'.$this->search.'%');
            });

        // -------------------------------
        //  SORTING & FILTERING
        // -------------------------------
        switch ($this->sort) {

            // Borrow date sorting
            case 'borrow_date_asc':
                $query->orderBy('borrowings.borrow_date', 'asc');
                break;

            case 'borrow_date_desc':
                $query->orderBy('borrowings.borrow_date', 'desc');
                break;

            // Due date sorting
            case 'due_date_asc':
                $query->orderBy('borrowings.due_date', 'asc');
                break;

            case 'due_date_desc':
                $query->orderBy('borrowings.due_date', 'desc');
                break;

            // Status filtering
            case 'returned':
                $query->where('borrowings.status', 'returned');
                break;

            case 'borrowed':
                $query->where('borrowings.status', 'borrowed');
                break;

            case 'overdue':
                $query->where('borrowings.status', 'overdue');
                break;
        }

        // Final pagination
        $borrowing_data = $query->paginate(10);

        return view('livewire.borrowings.borrowings-table', [
            'borrowing_data' => $borrowing_data,
        ]);
    }
}
