<div class="col-lg-9">
    <div class="row g-4">

        <!-- Account Summary -->
        <div class="col-12">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <h6>Current Balance</h6>
                        <span class="h4">${{ number_format($user->balance ?? 0, 2) }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <h6>Total Referrals</h6>
                        <span class="h4">{{ $totalReferrals }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <h6>Total Withdraw</h6>
                        <span class="h4">${{ number_format($totalWithdraw, 2) }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <h6>Total Commission</h6>
                        <span class="h4">${{ number_format($referralEarnings, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Packages List -->
        <div class="col-12">
            <div class="card p-3">
                <h5>My Packages</h5>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Billing Cycle</th>
                                <th>Status</th>
                                <th>First Buy</th>
                                <th>Renew</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($packages as $package)
                            <tr>
                                <td>{{ $package->name }}</td>
                                <td>{{ ucfirst($package->billing_cycle) }}</td>
                                <td>
                                    <span class="badge bg-{{ $package->is_active ? 'success' : 'danger' }}">
                                        {{ $package->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>${{ number_format($package->first_price, 2) }}</td>
                                <td>${{ number_format($package->renew_price, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No packages found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Referrals -->
        <div class="col-12">
            <div class="card p-3">
                <h5>Referrals</h5>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Generation</th>
                                <th>Commission %</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($referrals as $ref)
                            <tr>
                                <td>{{ $ref->name }}</td>
                                <td>{{ $ref->email }}</td>
                                <td>{{ $ref->generation }}</td>
                                <td>{{ $ref->commission_percent }}%</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No referrals yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Withdraw History -->
        <div class="col-12">
            <div class="card p-3">
                <h5>Withdraw History</h5>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
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
                            @forelse($withdraws as $withdraw)
                            <tr>
                                <td>{{ $withdraw->id }}</td>
                                <td>${{ $withdraw->amount }}</td>
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

    </div>
</div>