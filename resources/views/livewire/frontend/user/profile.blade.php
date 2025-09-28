<div class="col-lg-9">
    <div class="card p-4">
        <h4 class="mb-4">My Profile</h4>

        <!-- Tabs -->
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a href="#" class="nav-link @if($activeTab=='info') active @endif" wire:click.prevent="setTab('info')">Info</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link @if($activeTab=='password') active @endif" wire:click.prevent="setTab('password')">Password</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link @if($activeTab=='image') active @endif" wire:click.prevent="setTab('image')">Image</a>
            </li>
        </ul>

        <!-- Info Tab -->
        @if($activeTab=='info')
        <form wire:submit.prevent="updateInfo">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input type="text" wire:model="first_name" class="form-control @error('first_name') is-invalid @enderror">
                    @error('first_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" wire:model="last_name" class="form-control @error('last_name') is-invalid @enderror">
                    @error('last_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="trk-btn trk-btn--primary">Update Info</button>
                </div>
            </div>
        </form>
        @endif

        <!-- Password Tab -->
        @if($activeTab=='password')
        <form wire:submit.prevent="updatePassword">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Old Password</label>
                    <input type="password" wire:model="old_password" class="form-control @error('old_password') is-invalid @enderror">
                    @error('old_password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="col-12">
                    <label class="form-label">New Password</label>
                    <input type="password" wire:model="new_password" class="form-control @error('new_password') is-invalid @enderror">
                    @error('new_password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" wire:model="new_password_confirmation" class="form-control">
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="trk-btn trk-btn--primary">Update Password</button>
                </div>
            </div>
        </form>
        @endif

        <!-- Image Tab -->
        @if($activeTab=='image')
        <form wire:submit.prevent="updateImage" enctype="multipart/form-data">
            <div class="row g-3 text-center">
                <div class="col-12 mb-3">
                    <img src="{{ $image ? $image->temporaryUrl() : ($current_image ? asset('storage/' . $current_image) : url('assets/frontend/images/default-user.png')) }}"
                        class="rounded-circle" width="120" alt="Profile Image">
                </div>
                <div class="col-12">
                    <input type="file" wire:model="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    <small class="text-muted">Max size: 2MB</small>
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="trk-btn trk-btn--primary">Update Image</button>
                </div>
            </div>
        </form>
        @endif

    </div>
</div>