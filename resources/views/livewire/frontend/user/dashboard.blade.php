<div class="col-lg-9">
    <div class="row g-4">

        <!-- Account Summary -->
        <div class="col-12">
            <div class="card p-3">
                <h5>Account Summary</h5>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="card text-center p-3">
                            <h6>Total Referrals</h6>
                            <span class="h4">{{ $totalReferrals ?? 0 }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center p-3">
                            <h6>Referral Earnings</h6>
                            <span class="h4">${{ number_format($referralEarnings ?? 0, 2) }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center p-3">
                            <h6>Active Packages</h6>
                            <span class="h4">{{ $activePackages ?? 0 }}</span>
                        </div>
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
                            @forelse($packages ?? [] as $package)
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

        <!-- Referral Details -->
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
                            @forelse($referrals ?? [] as $ref)
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

    </div>
</div>