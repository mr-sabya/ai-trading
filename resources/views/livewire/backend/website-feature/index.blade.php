<div class="row">
    <!-- Form Column -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>{{ $websiteFeatureId ? 'Edit Feature' : 'Add Feature' }}</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror">
                        @error('title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tab Title</label>
                        <input type="text" wire:model="tab_title" class="form-control @error('tab_title') is-invalid @enderror">
                        @error('tab_title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                        @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Floating Top Text</label>
                        <input type="text" wire:model="floating_top_text" class="form-control @error('floating_top_text') is-invalid @enderror">
                        @error('floating_top_text') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Floating Bottom Number</label>
                        <input type="text" wire:model="floating_bottom_number" class="form-control @error('floating_bottom_number') is-invalid @enderror">
                        @error('floating_bottom_number') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Floating Bottom Text</label>
                        <input type="text" wire:model="floating_bottom_text" class="form-control @error('floating_bottom_text') is-invalid @enderror">
                        @error('floating_bottom_text') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Main Image</label>
                        <input type="file" wire:model="main_image" class="form-control">
                        @error('main_image') <span class="text-danger mt-1 d-block">{{ $message }}</span> @enderror
                        @if ($main_image) <img src="{{ $main_image->temporaryUrl() }}" class="img-thumbnail mt-2" style="max-height: 100px;">
                        @elseif ($current_main_image) <img src="{{ asset('storage/' . $current_main_image) }}" class="img-thumbnail mt-2" style="max-height: 100px;"> @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Floating Top Image</label>
                        <input type="file" wire:model="floating_top_image" class="form-control">
                        @error('floating_top_image') <span class="text-danger mt-1 d-block">{{ $message }}</span> @enderror
                        @if ($floating_top_image) <img src="{{ $floating_top_image->temporaryUrl() }}" class="img-thumbnail mt-2" style="max-height: 100px;">
                        @elseif ($current_floating_top_image) <img src="{{ asset('storage/' . $current_floating_top_image) }}" class="img-thumbnail mt-2" style="max-height: 100px;"> @endif
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" wire:model="is_active" class="form-check-input" id="isActive">
                        <label class="form-check-label" for="isActive">Active</label>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ $websiteFeatureId ? 'Update' : 'Save' }}</button>
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Column -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Website Features</h5>
                <input type="text" wire:model.live.debounce.300ms="search" class="form-control w-25" placeholder="Search...">
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th wire:click="sortBy('title')" style="cursor:pointer;">Title</th>
                                <th wire:click="sortBy('tab_title')" style="cursor:pointer;">Tab Title</th>
                                <th wire:click="sortBy('is_active')" style="cursor:pointer;">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($features as $feature)
                            <tr>
                                <td><img src="{{ asset('storage/' . $feature->main_image) }}" alt="{{ $feature->title }}" style="height: 40px;"></td>
                                <td>{{ $feature->title }}</td>
                                <td>{{ $feature->tab_title }}</td>
                                <td>
                                    <span class="badge bg-{{ $feature->is_active ? 'success' : 'danger' }}">
                                        {{ $feature->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <button wire:click="edit({{ $feature->id }})" class="btn btn-sm btn-primary">Edit</button>
                                    <button wire:click="confirmDelete({{ $feature->id }})" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No features found.</td>
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
                <div>{{ $features->links() }}</div>
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
                <div class="modal-body">Are you sure you want to delete this feature?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('confirmingDelete', false)">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @if($confirmingDelete)<div class="modal-backdrop fade show"></div>@endif
</div>