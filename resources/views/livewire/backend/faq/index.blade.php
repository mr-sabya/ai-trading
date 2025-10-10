<div class="row">
    <!-- Form Column -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>{{ $faqId ? 'Edit FAQ' : 'Add FAQ' }}</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label class="form-label">Question</label>
                        <input type="text" wire:model="question" class="form-control @error('question') is-invalid @enderror">
                        @error('question') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Answer</label>
                        <textarea wire:model="answer" class="form-control @error('answer') is-invalid @enderror" rows="5"></textarea>
                        @error('answer') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" wire:model="order" class="form-control @error('order') is-invalid @enderror">
                        @error('order') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{ $faqId ? 'Update' : 'Save' }}</button>
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Column -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Frequently Asked Questions</h5>
                <input type="text" wire:model.live.debounce.300ms="search" class="form-control w-25" placeholder="Search questions...">
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th wire:click="sortBy('question')" style="cursor:pointer;">Question</th>
                                <th wire:click="sortBy('order')" style="cursor:pointer;">Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($faqs as $faq)
                            <tr>
                                <td>{{ Str::limit($faq->question, 80) }}</td>
                                <td>{{ $faq->order }}</td>
                                <td>
                                    <button wire:click="edit({{ $faq->id }})" class="btn btn-sm btn-primary">Edit</button>
                                    <button wire:click="confirmDelete({{ $faq->id }})" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No FAQs found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <select wire:model.live="perPage" class="form-select form-select-sm w-auto">
                    <option>5</option>
                    <option>10</option>
                    <option>25</option>
                </select>
                <div>{{ $faqs->links() }}</div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal @if($confirmingDelete) fade show d-block @endif" tabindex="-1" style="@if(!$confirmingDelete) display:none; @endif">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete</h5><button type="button" class="btn-close" wire:click="$set('confirmingDelete', false)"></button>
                </div>
                <div class="modal-body">Are you sure you want to delete this FAQ?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('confirmingDelete', false)">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @if($confirmingDelete)<div class="modal-backdrop fade show"></div>@endif
</div>