<?php

namespace App\Livewire\Backend\Faq;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Faq;

class Index extends Component
{
    use WithPagination;

    public $faqId;
    public $question, $answer, $order = 0;

    // Table properties
    public $search = '';
    public $sortField = 'order';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $confirmingDelete = false;
    public $deleteId;

    protected function rules()
    {
        return [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'required|integer',
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function save()
    {
        $this->validate();

        Faq::updateOrCreate(['id' => $this->faqId], [
            'question' => $this->question,
            'answer' => $this->answer,
            'order' => $this->order,
        ]);

        $this->resetForm();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'FAQ saved successfully!']);
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        $this->faqId = $faq->id;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
        $this->order = $faq->order;
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        Faq::findOrFail($this->deleteId)->delete();
        $this->confirmingDelete = false;
        $this->dispatch('notify', ['type' => 'success', 'message' => 'FAQ deleted successfully!']);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function resetForm()
    {
        $this->reset();
        $this->order = 0; // Reset order to default
    }

    public function render()
    {
        $faqs = Faq::where('question', 'like', "%{$this->search}%")
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.backend.faq.index', ['faqs' => $faqs]);
    }
}
