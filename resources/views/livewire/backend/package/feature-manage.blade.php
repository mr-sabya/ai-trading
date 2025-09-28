<div class="row">
    <!-- Feature Form -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>{{ $featureId ? 'Edit Feature' : 'Add Feature' }} ({{ $package->name }})</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label class="form-label">Feature Name</label>
                        <input type="text" wire:model="feature_name" class="form-control @error('feature_name') is-invalid @enderror">
                        @error('feature_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Feature Value</label>
                        <input type="text" wire:model="feature_value" class="form-control @error('feature_value') is-invalid @enderror">
                        @error('feature_value') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" wire:model="is_limited" class="form-check-input" id="is_limited">
                        <label class="form-check-label" for="is_limited">Limited</label>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ $featureId ? 'Update' : 'Save' }}
                    </button>
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Feature Table -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Features for {{ $package->name }}</h5>
                <a href="{{ route('admin.packages.index') }}" class="btn btn-sm btn-secondary">Back to Packages</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Limited</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($features as $feature)
                        <tr>
                            <td>{{ $feature->feature_name }}</td>
                            <td>{{ $feature->feature_value }}</td>
                            <td>
                                <span class="badge bg-{{ $feature->is_limited ? 'warning' : 'success' }}">
                                    {{ $feature->is_limited ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td>
                                <button wire:click="edit({{ $feature->id }})" class="btn btn-sm btn-warning">Edit</button>
                                <button wire:click="confirmDelete({{ $feature->id }})" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No features found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $features->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal @if($confirmingDelete) fade show d-block @endif" tabindex="-1" style="@if(!$confirmingDelete) display:none; @endif">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" wire:click="$set('confirmingDelete', false)"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this feature?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('confirmingDelete', false)">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>