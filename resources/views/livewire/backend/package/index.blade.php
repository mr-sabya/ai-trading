<div class="row">
    <!-- Form Column -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>{{ $packageId ? 'Edit Package' : 'Add Package' }}</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                        @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Billing Cycle</label>
                        <select wire:model="billing_cycle" class="form-select @error('billing_cycle') is-invalid @enderror">
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                        @error('billing_cycle') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">First Price</label>
                        <input type="number" step="0.01" wire:model="first_price" class="form-control @error('first_price') is-invalid @enderror">
                        @error('first_price') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Renew Price</label>
                        <input type="number" step="0.01" wire:model="renew_price" class="form-control @error('renew_price') is-invalid @enderror">
                        @error('renew_price') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" wire:model="is_active" class="form-check-input" id="is_active">
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ $packageId ? 'Update' : 'Save' }}
                    </button>
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Column -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Packages</h5>
                <input type="text" wire:model.live="search" class="form-control w-25" placeholder="Search...">
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover mb-0">
                    <thead>
                        <tr>
                            <th wire:click="sortBy('name')" style="cursor:pointer">Name</th>
                            <th>Description</th>
                            <th wire:click="sortBy('billing_cycle')" style="cursor:pointer">Billing Cycle</th>
                            <th wire:click="sortBy('first_price')" style="cursor:pointer">First Price</th>
                            <th wire:click="sortBy('renew_price')" style="cursor:pointer">Renew Price</th>
                            <th wire:click="sortBy('is_active')" style="cursor:pointer">Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($packages as $package)
                        <tr>
                            <td>{{ $package->name }}</td>
                            <td>{{ $package->description }}</td>
                            <td>{{ ucfirst($package->billing_cycle) }}</td>
                            <td>{{ number_format($package->first_price, 2) }}</td>
                            <td>{{ number_format($package->renew_price, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $package->is_active ? 'success' : 'danger' }}">
                                    {{ $package->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $package->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $package->id }}">
                                        <li>
                                            <button wire:click="edit({{ $package->id }})" class="dropdown-item">
                                                Edit
                                            </button>
                                        </li>
                                        <li>
                                            <button wire:click="confirmDelete({{ $package->id }})" class="dropdown-item text-danger">
                                                Delete
                                            </button>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.packages.features', $package->id) }}" wire:navigate class="dropdown-item">
                                                Features
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No packages found.</td>
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
                <div>{{ $packages->links() }}</div>
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
                <div class="modal-body">
                    Are you sure you want to delete this package?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('confirmingDelete', false)">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>