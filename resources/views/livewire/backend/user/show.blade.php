<div>
    {{-- Summary Cards --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">User Details</h5>
            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary btn-sm">Back</a>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Current Balance</h6>
                    <h4 class="fw-bold text-success">{{ number_format($user->balance, 2) }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Referrals</h6>
                    <h4 class="fw-bold">{{ $totalReferrals }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Withdraw</h6>
                    <h4 class="fw-bold text-danger">{{ number_format($totalWithdraw, 2) }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Commission</h6>
                    <h4 class="fw-bold text-primary">{{ number_format($totalCommission, 2) }}</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- User Info --}}
    <div class="card mb-4">


        <div class="card-body">
            <h6><strong>Name:</strong> {{ $user->name }}</h6>
            <h6><strong>Email:</strong> {{ $user->email }}</h6>
            <h6><strong>Referral Code:</strong> {{ $user->refer_code }}</h6>
            <h6><strong>Referred By:</strong> {{ $user->referrer?->name ?? '-' }}</h6>
        </div>
    </div>

    {{-- Referral Generations --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5>Referral Generations</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th>Generation</th>
                        <th>Referrer</th>
                        <th>Commission %</th>
                        <th>Commission (If Purchase)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($generations as $gen)
                    <tr>
                        <td>{{ $gen['generation'] }}</td>
                        <td>{{ $gen['referrer_name'] }}</td>
                        <td>{{ $gen['commission_percent'] }}%</td>
                        <td>{{ $gen['commission_amount'] ? number_format($gen['commission_amount'], 2) : '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No referrers found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Purchases --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5>Purchases</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Package</th>
                        <th>First Price</th>
                        <th>Renew Price</th>
                        <th>Status</th>
                        <th>Expires</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($user->purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->id }}</td>
                        <td>{{ $purchase->package->name ?? '-' }}</td>
                        <td>{{ $purchase->first_price }}</td>
                        <td>{{ $purchase->renew_price }}</td>
                        <td>
                            <span class="badge bg-{{ $purchase->isActive() ? 'success' : 'danger' }}">
                                {{ ucfirst($purchase->status) }}
                            </span>
                        </td>
                        <td>{{ $purchase->expires_at?->format('d M Y') ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No purchases found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Purchase History --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5>Purchase History</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Purchase ID</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Transaction Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($user->purchases->flatMap->histories as $history)
                    <tr>
                        <td>{{ $history->id }}</td>
                        <td>{{ $history->purchase_id }}</td>
                        <td>{{ ucfirst($history->type) }}</td>
                        <td>{{ $history->amount }}</td>
                        <td>{{ $history->transaction_date?->format('d M Y h:i A') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No purchase history found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Referral Commissions --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5>Referral Commissions</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Purchase</th>
                        <th>Referred User</th>
                        <th>Generation</th>
                        <th>Amount</th>
                        <th>Commission %</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($user->referralCommissions as $commission)
                    <tr>
                        <td>{{ $commission->id }}</td>
                        <td>{{ $commission->purchase_id }}</td>
                        <td>{{ $commission->referredUser?->name }}</td>
                        <td>{{ $commission->generation }}</td>
                        <td>{{ $commission->amount }}</td>
                        <td>{{ $commission->commission_percent }}%</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No commissions found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Withdraw History --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5>Withdraw History</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Amount</th>
                        <th>Binance ID</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($user->withdraws as $withdraw)
                    <tr>
                        <td>{{ $withdraw->id }}</td>
                        <td>{{ $withdraw->amount }}</td>
                        <td>{{ $withdraw->binance_id }}</td>
                        <td>
                            <span class="badge bg-{{ $withdraw->status == 'approved' ? 'success' : ($withdraw->status == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($withdraw->status) }}
                            </span>
                        </td>
                        <td>{{ $withdraw->created_at?->format('d M Y h:i A') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No withdraws found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>