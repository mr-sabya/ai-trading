<div class="container py-5">
    @if($package)
    <div class="row justify-content-center">
        <!-- Checkout Section -->
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-header bg-gradient bg-success text-white d-flex justify-content-between align-items-center">
                    <div class="mb-0 text-white card-title fw-bold">Checkout</div>
                    <p class="small mb-0"><i class="bi bi-lock-fill me-1"></i> Secure Payment</p>
                </div>

                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">{{ $package->name }}</h5>
                    <p class="text-muted">{{ $package->description }}</p>

                    <hr>

                    <div class="mb-3">
                        <h6 class="fw-semibold">Features:</h6>
                        <ul class="list-unstyled">
                            @foreach($package->features as $feature)
                            <li class="mb-1"><i class="bi bi-check-circle text-success me-2"></i>{{ $feature->feature_name }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <h6 class="mb-1">Billing Cycle</h6>
                            <p class="fw-semibold text-capitalize">{{ $package->billing_cycle }}</p>
                        </div>
                        <div class="col-sm-6 text-end">
                            <h6 class="mb-1">Total</h6>
                            <h3 class="fw-bold text-success">${{ number_format($price, 2) }}</h3>
                        </div>
                    </div>

                    <div class="d-flex gap-5 align-items-center mb-2" style="background: #d4d4d4ff; border-radius: 10px; padding: 20px;">
                        <p class="m-0">Binance Pay (USDT only)</p>
                        <img src="{{ url('assets/frontend/images/Pay.png')}}" alt="">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3" style="background: #d4d4d4ff; border-radius: 10px; padding: 20px;">
                        <p class="m-0">TUMHkXa6FBfGxuriahgdqMLujk8wg9Rdsp</p>
                        <button class="btn btn-sm btn-success"><i class="fa-solid fa-copy"></i></button>
                    </div>


                    <!-- Before the Proceed to Payment button -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Binance Order ID</label>
                        <input type="text" wire:model.defer="binanceOrderId"
                            class="form-control @error('binanceOrderId') is-invalid @enderror"
                            placeholder="Enter your Binance Order ID">
                        @error('binanceOrderId')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#">privacy policy</a>.</p>

                    <button wire:click="confirmCheckout"
                        class="btn btn-lg btn-success w-100"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove>Proceed to Payment</span>
                        <span wire:loading><i class="spinner-border spinner-border-sm"></i> Processing...</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success fw-bold text-white">Order Summary</div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Plan:</span> <strong>{{ $package->name }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Cycle:</span> <strong class="text-capitalize">{{ $package->billing_cycle }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Price:</span> <strong>${{ number_format($price, 2) }}</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h6 class="fw-bold mb-0">Total</h6>
                        <h6 class="fw-bold mb-0 text-success">${{ number_format($price, 2) }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    @if($confirming)
    <div class="modal fade show d-block" tabindex="-1" style="background:rgba(0,0,0,0.5)">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Confirm Your Purchase</h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="$set('confirming', false)"></button>
                </div>
                <div class="modal-body">
                    <p>You're about to subscribe to <strong>{{ $package->name }}</strong> plan.</p>
                    <p>Total amount: <strong>${{ number_format($price, 2) }}</strong></p>
                    <p>Billing cycle: <strong>{{ ucfirst($billing_cycle) }}</strong></p>
                    <p class="text-muted small mb-0"><i class="bi bi-info-circle me-1"></i>Your plan will automatically expire after the cycle period.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="$set('confirming', false)">Cancel</button>
                    <button class="btn btn-success" wire:click="completeCheckout" wire:loading.attr="disabled">
                        <span wire:loading.remove>Confirm Checkout</span>
                        <span wire:loading><i class="spinner-border spinner-border-sm"></i> Processing...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @else
    <div class="alert alert-info text-center py-5">
        <i class="bi bi-box-seam display-5 d-block mb-3"></i>
        <h5>No Package Selected</h5>
        <p>Select a package to start checkout.</p>
    </div>
    @endif
</div>