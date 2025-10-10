<div class="row">
    <!-- Form Column -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>{{ $partnerId ? 'Edit Partner' : 'Add Partner' }}</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Link</label>
                        <input type="text" wire:model="link" class="form-control @error('link') is-invalid @enderror">
                        @error('link') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        <input type="file" wire:model="logo" class="form-control @error('logo') is-invalid @enderror">
                        <div wire:loading wire:target="logo" class="text-primary mt-1">Uploading...</div>
                        @error('logo') <span class="text-danger mt-1 d-block">{{ $message }}</span> @enderror

                        <div class="mt-2">
                            @if ($logo)
                            <img src="{{ $logo->temporaryUrl() }}" class="img-thumbnail" style="max-height: 100px;">
                            @elseif ($current_logo)
                            <img src="{{ asset('storage/' . $current_logo) }}" class="img-thumbnail" style="max-height: 100px;">
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ $partnerId ? 'Update' : 'Save' }}
                    </button>
                    @if($partnerId)
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">Cancel</button>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Table Column -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Partners</h5>
                <input type="text" wire:model.live.debounce.300ms="search" class="form-control w-25" placeholder="Search...">
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th wire:click="sortBy('name')" style="cursor:pointer;">Name <i class="fas fa-sort"></i></th>
                                <th>Link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($partners as $partner)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" style="height: 40px; width: auto;">
                                </td>
                                <td>{{ $partner->name }}</td>
                                <td><a href="{{ $partner->link }}" target="_blank">{{ $partner->link }}</a></td>
                                <td>
                                    <button wire:click="edit({{ $partner->id }})" class="btn btn-sm btn-primary">Edit</button>
                                    <button wire:click="confirmDelete({{ $partner->id }})" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No partners found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div>
                    <select wire:model.live="perPage" class="form-select form-select-sm w-auto">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                    </select>
                </div>
                <div>{{ $partners->links() }}</div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal @if($confirmingDelete) fade show d-block @endif" tabindex="-1" style="@if(!$confirmingDelete) display:none; @endif" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" wire:click="$set('confirmingDelete', false)"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this partner? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('confirmingDelete', false)">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @if($confirmingDelete)
    <div class="modal-backdrop fade show"></div>
    @endif
</div>