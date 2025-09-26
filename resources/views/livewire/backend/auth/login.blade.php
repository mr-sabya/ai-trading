<div class="login-card">
    <!-- logo -->
    <div class="d-flex justify-content-center mb-4">
        <a href="/" class="text-center">
            <img src="{{ url('assets/backend/img/kaiadmin/logo_dark.svg') }}" alt="CoreDesk Logo" class="login-logo" style="width: 200px;">
        </a>
    </div>
    <h3 class="mb-5">Welcome to CoreDesk</h3>

    {{-- The form now calls the 'login' method on submission --}}
    <form wire:submit.prevent="login">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            {{-- wire:model binds this input to the $email property in the component --}}
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model="email" placeholder="Enter your email" required autofocus>

            {{-- This will display any validation or authentication errors --}}
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model="password" placeholder="Enter password" required>

            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember me -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" wire:model="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>

        <!-- Submit Button with Loading State -->
        <button type="submit" class="btn btn-login w-100" wire:loading.attr="disabled">
            {{-- Show different text based on the loading state of the 'login' action --}}
            <span wire:loading.remove wire:target="login">
                Login
            </span>
            <span wire:loading wire:target="login">
                Processing...
            </span>
        </button>
    </form>
</div>