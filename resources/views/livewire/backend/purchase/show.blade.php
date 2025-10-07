<div>
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Purchase Details</h4>
            <div>
                @if($purchase->status === 'pending')
                <button class="btn btn-success btn-sm me-2" wire:click="confirmApprove">
                    <i class="bi bi-check-circle"></i> Approve
                </button>
                <button class="btn btn-danger btn-sm" wire:click="confirmCancel">
                    <i class="bi bi-x-circle"></i> Cancel
                </button>
                @elseif($purchase->status === 'approved')
                <span class="badge bg-success">Approved</span>
                @elseif($purchase->status === 'cancelled')
                <span class="badge bg-danger">Cancelled</span>
                @endif
            </div>
        </div>

        <div class="row">
            {{-- Left Column: Purchase Details --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Purchase Information</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <th>ID:</th>
                                <td>#{{ $purchase->id }}</td>
                            </tr>
                            <tr>
                                <th>User:</th>
                                <td>{{ $purchase->user->name ?? 'N/A' }} ({{ $purchase->user->email ?? '' }})</td>
                            </tr>
                            <tr>
                                <th>Package:</th>
                                <td>{{ $purchase->package->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <span class="badge 
                                        @if($purchase->status === 'approved') bg-success
                                        @elseif($purchase->status === 'pending') bg-warning
                                        @elseif($purchase->status === 'cancelled') bg-danger
                                        @else bg-secondary @endif">
                                        {{ ucfirst($purchase->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Binance Order ID:</th>
                                <td>{{ $purchase->binance_order_id ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Amount:</th>
                                <td>${{ number_format($purchase->first_price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Billing Cycle:</th>
                                <td>{{ ucfirst($purchase->package->billing_cycle ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <th>Start Date:</th>
                                <td>{{ $purchase->created_at->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <th>Expiry Date:</th>
                                <td>{{ $purchase->expires_at ? $purchase->expires_at->format('d M Y') : 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Right Column: History + Referral Commissions --}}
            <div class="col-md-6">
                {{-- Purchase History --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Purchase History</h5>
                    </div>
                    <div class="card-body">
                        @if($purchase->histories->count())
                        <table class="table table-bordered table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchase->histories as $history)
                                <tr>
                                    <td>{{ $history->created_at->format('d M Y h:i A') }}</td>
                                    <td><span class="badge bg-info text-dark">{{ ucfirst($history->status) }}</span></td>
                                    <td>${{ number_format($history->amount, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="text-muted">No history records found.</p>
                        @endif
                    </div>
                </div>

                {{-- Referral Commissions --}}
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Referral Commissions</h5>
                    </div>
                    <div class="card-body">
                        @if($purchase->referralCommissions->count())
                        <table class="table table-bordered table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Generation</th>
                                    <th>Referrer</th>
                                    <th>Percent</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchase->referralCommissions as $commission)
                                <tr>
                                    <td>{{ $commission->generation }}</td>
                                    <td>{{ $commission->user->name ?? 'N/A' }}</td>
                                    <td>{{ $commission->commission_percent }}%</td>
                                    <td>${{ number_format($commission->amount, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="text-muted">No referral commissions found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Approve Modal --}}
    <div class="modal fade @if($confirmingApprove) show d-block @endif" tabindex="-1" style="background: rgba(0,0,0,0.5);" wire:click.self="$set('confirmingApprove', false)">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Confirm Approval</h5>
                    <button type="button" class="btn-close" wire:click="$set('confirmingApprove', false)"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to approve this purchase?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="$set('confirmingApprove', false)">Cancel</button>
                    <button class="btn btn-success" wire:click="approvePurchase">Yes, Approve</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Cancel Modal --}}
    <div class="modal fade @if($confirmingCancel) show d-block @endif" tabindex="-1" style="background: rgba(0,0,0,0.5);" wire:click.self="$set('confirmingCancel', false)">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Cancellation</h5>
                    <button type="button" class="btn-close" wire:click="$set('confirmingCancel', false)"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to cancel this purchase?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="$set('confirmingCancel', false)">Close</button>
                    <button class="btn btn-danger" wire:click="cancelPurchase">Yes, Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>