<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>{{ $userId ? 'Edit User' : 'Add User' }}</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        @if($userId)
                        <small class="text-muted">Leave blank if you don't want to change the password.</small>
                        @endif
                    </div>

                    <!-- Referrer Code -->
                    <div class="mb-3">
                        <label class="form-label">Referrer Code</label>
                        <div class="input-group">
                            <input type="text" wire:model.lazy="refer" class="form-control @error('refer') is-invalid @enderror" placeholder="Enter referrer's code">
                            <button type="button" class="btn btn-outline-primary" wire:click="findReferUser">Check</button>
                        </div>
                        @error('refer') <span class="invalid-feedback">{{ $message }}</span> @enderror

                        @if($referrer_id)
                        <small class="text-success">Referrer user ID: {{ $referrer_id }}</small>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ $userId ? 'Update' : 'Save' }}
                    </button>
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>