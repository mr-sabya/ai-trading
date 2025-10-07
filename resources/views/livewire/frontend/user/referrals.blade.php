<div class="col-lg-9">
    <div class="row g-4">

        <!-- Referrals Table -->
        <div class="col-12">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>My Referrals</h5>
                    <input type="text" class="form-control w-25" placeholder="Search..." wire:model.debounce.500ms="search">
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Generation</th>
                                <th>Commission %</th>
                                <th>Commission Earned</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($referrals as $ref)
                            @php
                            $genData = collect($generations)->firstWhere('referrer_id', $ref->id);
                            @endphp
                            <tr>
                                <td>{{ $ref->name }}</td>
                                <td>{{ $ref->email }}</td>
                                <td>{{ $genData['generation'] ?? '-' }}</td>
                                <td>{{ $genData['commission_percent'] ?? '-' }}%</td>
                                <td>
                                    @if($ref->purchases)
                                    ${{ number_format($ref->purchases->flatMap->referralCommissions
                                            ->where('user_id', Auth::id())
                                            ->sum('amount'), 2) }}
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No referrals found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">{{ $referrals->links() }}</div>
                </div>
            </div>
        </div>

    </div>
</div>