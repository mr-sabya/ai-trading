<div class="col-lg-9">
    <div class="row g-4">

        <!-- Button to open modal -->
        <div class="col-12">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#withdrawModal">
                Request Withdraw
            </button>
        </div>

        <!-- Withdraw Modal -->
        <div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="withdrawModalLabel">Request Withdraw</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="submit">
                            <div class="mb-3">
                                <label>Amount</label>
                                <input type="number" wire:model="amount" class="form-control" min="1" step="0.01">
                                @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label>Binance ID</label>
                                <input type="text" wire:model="binance_id" class="form-control">
                                @error('binance_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label>Notes (optional)</label>
                                <textarea wire:model="notes" class="form-control" rows="2"></textarea>
                                @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Withdraw History -->
        <div class="col-12">
            <div class="card p-3">
                <h5>Withdraw History</h5>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Amount</th>
                                <th>Binance ID</th>
                                <th>Status</th>
                                <th>Notes</th>
                                <th>Requested At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($withdraws as $w)
                            <tr>
                                <td>{{ $w->id }}</td>
                                <td>${{ number_format($w->amount,2) }}</td>
                                <td>{{ $w->binance_id }}</td>
                                <td>
                                    <span class="badge bg-{{ $w->status == 'approved' ? 'success' : ($w->status == 'rejected' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($w->status) }}
                                    </span>
                                </td>
                                <td>{{ $w->notes ?? '-' }}</td>
                                <td>{{ $w->created_at->format('d M Y h:i A') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No withdraws yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">{{ $withdraws->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>