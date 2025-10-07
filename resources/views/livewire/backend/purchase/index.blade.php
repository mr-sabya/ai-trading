<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Manage Purchases</h5>
        <input type="text" wire:model.live="search" class="form-control w-25" placeholder="Search by ID, User, or Package...">
    </div>
    <div class="card-body p-0">
        <table class="table table-bordered table-hover mb-0">
            <thead>
                <tr>
                    <th wire:click="sortBy('id')" style="cursor:pointer">ID</th>
                    <th wire:click="sortBy('user_id')" style="cursor:pointer">User</th>
                    <th wire:click="sortBy('package_id')" style="cursor:pointer">Package</th>
                    <th wire:click="sortBy('first_price')" style="cursor:pointer">Price</th>
                    <th wire:click="sortBy('first_price')" style="cursor:pointer">Binance Order ID</th>
                    <th wire:click="sortBy('status')" style="cursor:pointer">Status</th>
                    <th wire:click="sortBy('expires_at')" style="cursor:pointer">Expires At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->id }}</td>
                    <td>{{ $purchase->user->name ?? 'N/A' }} ({{ $purchase->user->email ?? 'N/A' }})</td>
                    <td>{{ $purchase->package->name ?? 'N/A' }}</td>
                    <td>${{ number_format($purchase->first_price, 2) }}</td>
                    <td>{{ $purchase->binance_order_id }}</td>
                    <td>
                        {{-- Status Badge Design --}}
                        @php
                        $badgeClass = '';
                        switch($purchase->status) {
                        case 'pending':
                        $badgeClass = 'bg-warning text-dark'; // Yellow for pending
                        break;
                        case 'approved':
                        $badgeClass = 'bg-success'; // Green for approved
                        break;
                        case 'cancelled':
                        $badgeClass = 'bg-danger'; // Red for cancelled
                        break;
                        default:
                        $badgeClass = 'bg-secondary'; // Default for unknown status
                        }
                        @endphp
                        <span class="badge {{ $badgeClass }}">
                            {{ ucfirst($purchase->status) }}
                        </span>
                    </td>
                    <td>
                        @if ($purchase->expires_at)
                        {{ $purchase->expires_at->format('d M Y') }}
                        @if ($purchase->isExpired())
                        <span class="badge bg-secondary">Expired</span>
                        @endif
                        @else
                        N/A
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('admin.purchase.show', $purchase->id) }}" wire:navigate class="dropdown-item text-success">Show</a></li>
                                @if ($purchase->status === 'pending')
                                <li><button wire:click="confirmApprove({{ $purchase->id }})" class="dropdown-item text-success">Approve</button></li>
                                <li><button wire:click="confirmCancel({{ $purchase->id }})" class="dropdown-item text-warning">Cancel</button></li>
                                @elseif ($purchase->status === 'approved')
                                <li><button wire:click="confirmCancel({{ $purchase->id }})" class="dropdown-item text-warning">Cancel</button></li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><button wire:click="confirmDelete({{ $purchase->id }})" class="dropdown-item text-danger">Delete</button></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No purchases found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center">
        <div>
            <select wire:model.live="perPage" class="form-select form-select-sm w-auto">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>
        <div>{{ $purchases->links() }}</div>
    </div>

    {{-- Approve Confirmation Modal --}}
    <div class="modal @if($confirmingApprove) fade show d-block @endif" tabindex="-1" style="@if(!$confirmingApprove) display:none; @endif">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Confirm Approval</h5>
                    <button type="button" class="btn-close" wire:click="$set('confirmingApprove', false)"></button>
                </div>
                <div class="modal-body">Are you sure you want to **approve** this purchase? This will activate the subscription.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('confirmingApprove', false)">Cancel</button>
                    <button type="button" class="btn btn-success" wire:click="approvePurchase">Approve</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Cancel Confirmation Modal --}}
    <div class="modal @if($confirmingCancel) fade show d-block @endif" tabindex="-1" style="@if(!$confirmingCancel) display:none; @endif">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">Confirm Cancellation</h5>
                    <button type="button" class="btn-close" wire:click="$set('confirmingCancel', false)"></button>
                </div>
                <div class="modal-body">Are you sure you want to **cancel** this purchase? This will deactivate the subscription.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('confirmingCancel', false)">Cancel</button>
                    <button type="button" class="btn btn-warning" wire:click="cancelPurchase">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal @if($confirmingDelete) fade show d-block @endif" tabindex="-1" style="@if(!$confirmingDelete) display:none; @endif">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" wire:click="$set('confirmingDelete', false)"></button>
                </div>
                <div class="modal-body">Are you sure you want to **delete** this purchase permanently? This action cannot be undone.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('confirmingDelete', false)">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deletePurchase">Delete</button>
                </div>
            </div>
        </div>
    </div>

</div>