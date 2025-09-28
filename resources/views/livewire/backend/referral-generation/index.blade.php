<div class="row">
    <!-- Form Column -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>{{ $refGenId ? 'Edit Referral Generation' : 'Add Referral Generation' }}</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label class="form-label">Generation</label>
                        <input type="number" wire:model="generation" class="form-control @error('generation') is-invalid @enderror">
                        @error('generation') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Commission %</label>
                        <input type="number" step="0.01" wire:model="commission_percent" class="form-control @error('commission_percent') is-invalid @enderror">
                        @error('commission_percent') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">{{ $refGenId ? 'Update' : 'Save' }}</button>
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Column -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Referral Generations</h5>
                <input type="text" wire:model.live="search" class="form-control w-25" placeholder="Search...">
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover mb-0">
                    <thead>
                        <tr>
                            <th wire:click="sortBy('generation')" style="cursor:pointer">Generation</th>
                            <th wire:click="sortBy('commission_percent')" style="cursor:pointer">Commission %</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($refGens as $gen)
                        <tr>
                            <td>{{ $gen->generation }}</td>
                            <td>{{ $gen->commission_percent }}%</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $gen->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $gen->id }}">
                                        <li><button wire:click="edit({{ $gen->id }})" class="dropdown-item">Edit</button></li>
                                        <li><button wire:click="confirmDelete({{ $gen->id }})" class="dropdown-item text-danger">Delete</button></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">No referral generations found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div>
                    <select wire:model="perPage" class="form-select form-select-sm w-auto">
                        <option>5</option>
                        <option>10</option>
                        <option>25</option>
                    </select>
                </div>
                <div>{{ $refGens->links() }}</div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal @if($confirmingDelete) fade show d-block @endif" tabindex="-1" style="@if(!$confirmingDelete) display:none; @endif">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" wire:click="$set('confirmingDelete', false)"></button>
                </div>
                <div class="modal-body">Are you sure you want to delete this referral generation?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('confirmingDelete', false)">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>