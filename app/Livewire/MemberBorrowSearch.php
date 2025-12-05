<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;

class MemberBorrowSearch extends Component
{
    public $query = '';

    public $results = [];

    public $selectedMember = null;

    public function updatedQuery()
    {
        $this->results = Member::where('name', 'like', '%'.$this->query.'%')
            ->limit(5)
            ->get();
    }

    public function selectMember($memberId)
    {
        $member = Member::find($memberId);
        $this->selectedMember = $member;
        $this->query = $member->name;
        $this->results = [];

        $this->dispatch('member-selected', memberId: $memberId);
    }

    public $selectedMemberId = null;

    public function mount($selectedMemberId = null)
    {
        if ($selectedMemberId) {
            $this->selectedMemberId = $selectedMemberId;
            $this->selectedMember = Member::find($selectedMemberId);
            $this->query = $this->selectedMember->name ?? '';
        }
    }

    public function render()
    {
        return view('livewire.borrowings.member-borrow-search');
    }
}
