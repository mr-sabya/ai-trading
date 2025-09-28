<div class="col-lg-9">

    <h2 class="mb-4">Available Packages</h2>
    <div class="row g-4">
        @foreach($packages as $package)
        <div class="col-md-4">
            <div class="card p-3">
                <h5>{{ $package->name }}</h5>
                <p>{{ $package->description }}</p>
                <p><strong>Billing:</strong> {{ ucfirst($package->billing_cycle) }}</p>
                <p><strong>First Price:</strong> ${{ number_format($package->first_price, 2) }}</p>
                <p><strong>Renew Price:</strong> ${{ number_format($package->renew_price, 2) }}</p>

                <button wire:click="buy({{ $package->id }})" class="btn btn-primary w-100">Buy Package</button>
            </div>
        </div>
        @endforeach
    </div>

    @if(Auth::check())
    <h2 class="mt-5 mb-4">My Purchases</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Package</th>
                    <th>Status</th>
                    <th>Expires At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($userPurchases as $purchase)
                <tr>
                    <td>{{ $purchase->package->name }}</td>
                    <td>
                        <span class="badge bg-{{ $purchase->isActive() ? 'success' : 'danger' }}">
                            {{ $purchase->isActive() ? 'Active' : 'Expired' }}
                        </span>
                    </td>
                    <td>{{ $purchase->expires_at->format('d M Y') }}</td>
                    <td>
                        <button wire:click="renew({{ $purchase->id }})" class="btn btn-sm btn-warning">Renew</button>
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