<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Users</h5>
        <input type="text" wire:model.live="search" class="form-control w-25" placeholder="Search...">
    </div>
    <div class="card-body p-0">
        <table class="table table-bordered table-hover mb-0">
            <thead>
                <tr>
                    <th wire:click="sortBy('name')" style="cursor:pointer">Name</th>
                    <th wire:click="sortBy('email')" style="cursor:pointer">Email</th>
                    <th>Referral Code</th>
                    <th>Referred By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->refer_code }}</td>
                    <td>{{ $user->referrer?->name ?? '-' }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('admin.user.show', $user->id) }}" wire:navigate class="dropdown-item">Show</a></li>
                                <li><a href="{{ route('admin.user.edit', $user->id) }}" wire:navigate class="dropdown-item">Edit</a></li>
                                <li><button wire:click="confirmDelete({{ $user->id }})" class="dropdown-item text-danger">Delete</button></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No users found.</td>
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
        <div>{{ $users->links() }}</div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal @if($confirmingDelete) fade show d-block @endif" tabindex="-1" style="@if(!$confirmingDelete) display:none; @endif">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" wire:click="$set('confirmingDelete', false)"></button>
                </div>
                <div class="modal-body">Are you sure you want to delete this user?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('confirmingDelete', false)">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>