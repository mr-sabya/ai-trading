<div class="row">
    <!-- Form Column -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>{{ $teamMemberId ? 'Edit Team Member' : 'Add Team Member' }}</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" wire:model.live="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" wire:model="slug" class="form-control @error('slug') is-invalid @enderror">
                        @error('slug') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Designation</label>
                        <input type="text" wire:model="designation" class="form-control @error('designation') is-invalid @enderror">
                        @error('designation') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Facebook URL</label>
                        <input type="url" wire:model="facebook" class="form-control @error('facebook') is-invalid @enderror">
                        @error('facebook') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Twitter URL</label>
                        <input type="url" wire:model="twitter" class="form-control @error('twitter') is-invalid @enderror">
                        @error('twitter') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url" wire:model="linkedin" class="form-control @error('linkedin') is-invalid @enderror">
                        @error('linkedin') <span class="invalid-feedback">{{ $message }}</span> @enderror
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
                    <button type="submit" class="btn btn-primary">{{ $teamMemberId ? 'Update' : 'Save' }}</button>
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Column -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Team Members</h5>
                <input type="text" wire:model.live.debounce.300ms="search" class="form-control w-25" placeholder="Search...">
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th wire:click="sortBy('name')" style="cursor:pointer;">Name</th>
                                <th wire:click="sortBy('designation')" style="cursor:pointer;">Designation</th>
                                <th wire:click="sortBy('order')" style="cursor:pointer;">Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teamMembers as $member)
                            <tr>
                                <td>
                                    @if($member->image)
                                    <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" style="height: 40px; width: 40px; object-fit: cover; border-radius: 50%;">
                                    @else
                                    <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->designation }}</td>
                                <td>{{ $member->order }}</td>
                                <td>
                                    <button wire:click="edit({{ $member->id }})" class="btn btn-sm btn-primary">Edit</button>
                                    <button wire:click="confirmDelete({{ $member->id }})" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No team members found.</td>
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
                <div>{{ $teamMembers->links() }}</div>
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
                <div class="modal-body">Are you sure you want to delete this team member?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('confirmingDelete', false)">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @if($confirmingDelete)<div class="modal-backdrop fade show"></div>@endif
</div>