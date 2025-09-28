<div class="col-lg-3">
    <div class="card p-3">
        <div class="text-center mb-3">
            <img src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : url('assets/frontend/images/default-user.png') }}"
                alt="Profile Image" class="rounded-circle" width="100">
            <h5 class="mt-2">{{ auth()->user()->name }}</h5>
            <small class="text-muted">{{ auth()->user()->email }}</small>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="{{ route('dashboard.index') }}" wire:navigate class="text-decoration-none">Dashboard</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('profile.index') }}" wire:navigate class="text-decoration-none">Profile</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('profile.package') }}" wire:navigate class="text-decoration-none">My Packages</a>
            </li>
            <li class="list-group-item">
                <a href="#" class="text-decoration-none">Referrals</a>
            </li>
            <li class="list-group-item">
                <a href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="text-decoration-none text-danger">
                    Logout
                </a>
            </li>
        </ul>
    </div>
</div>