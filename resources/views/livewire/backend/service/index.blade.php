<div class="row">
    <!-- Form Column -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>{{ $serviceId ? 'Edit Service' : 'Add Service' }}</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" wire:model.live="title" class="form-control @error('title') is-invalid @enderror">
                        @error('title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" wire:model="slug" class="form-control @error('slug') is-invalid @enderror">
                        @error('slug') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                        @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" wire:model="order" class="form-control @error('order') is-invalid @enderror">
                        @error('order') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" wire:model="image" class="form-control">
                        @error('image') <span class="text-danger mt-1 d-block">{{ $message }}</span> @enderror

                        <div class="mt-2">
                            @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" style="max-height: 100px;">
                            @elseif ($current_image)
                            <img src="{{ asset('storage/' . $current_image) }}" class="img-thumbnail" style="max-height: 100px;">
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ $serviceId ? 'Update' : 'Save' }}</button>
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Column -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Services</h5>
                <input type="text" wire:model.live.debounce.300ms="search" class="form-control w-25" placeholder="Search...">
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th wire:click="sortBy('title')" style="cursor:pointer;">Title</th>
                                <th wire:click="sortBy('slug')" style="cursor:pointer;">Slug</th>
                                <th wire:click="sortBy('order')" style="cursor:pointer;">Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $service)
                            <tr>
                                <td>
                                    @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" style="height: 40px;">
                                    @else
                                    <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $service->title }}</td>
                                <td>{{ $service->slug }}</td>
                                <td>{{ $service->order }}</td>
                                <td>
                                    <button wire:click="edit({{ $service->id }})" class="btn btn-sm btn-primary">Edit</button>
                                    <button wire:click="confirmDelete({{ $service->id }})" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No services found.</td>
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
                <div>{{ $services->links() }}</div>
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
                <div class="modal-body">Are you sure you want to delete this service?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('confirmingDelete', false)">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @if($confirmingDelete)<div class="modal-backdrop fade show"></div>@endif
</div>