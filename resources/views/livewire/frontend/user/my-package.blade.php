<div class="col-lg-9">

    @if(Auth::check())
    <h2 class="mt-5 mb-4">My Purchases</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Package</th>
                    <th>Status</th>
                    <th>Expires Status</th>
                    <th>Expires At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($userPurchases as $purchase)
                <tr>
                    <td>{{ $purchase->package->name }}</td>
                    <td>
                        {{-- Design the status based on its value --}}
                        @php
                        $badgeClass = '';
                        switch($purchase->status) {
                        case 'pending':
                        $badgeClass = 'bg-warning'; // Yellow for pending
                        break;
                        case 'approved':
                        $badgeClass = 'bg-success'; // Green for completed
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
                        @if ($purchase->isExpired())
                        <span class="badge bg-danger">Expired</span>
                        @else
                        <span class="badge bg-success">Active</span>
                        @endif
                        {{-- You could combine this with your existing status logic --}}
                    </td>
                    <td>{{ $purchase->expires_at->format('d M Y') }}</td>
                    <td>
                        {{-- You can now use isExpired() for conditional logic --}}
                        @if ($purchase->isExpired() || $purchase->status === 'cancelled')
                        <button class="btn btn-sm btn-secondary" disabled>Renew</button>
                        @else
                        <button wire:click="renew({{ $purchase->id }})" class="btn btn-sm btn-warning">Renew</button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No purchases found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h2 class="mt-5 mb-4">Purchase History</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Package</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($userPurchases->flatMap->histories() as $history)
                <tr>
                    <td>{{ $history->package->name }}</td>
                    <td>{{ ucfirst($history->type) }}</td>
                    <td>${{ number_format($history->amount, 2) }}</td>
                    <td>{{ $history->transaction_date->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No history found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif

</div>