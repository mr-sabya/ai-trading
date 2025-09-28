<div class="card p-4">
    <h5 class="mb-4">Logos & Favicon</h5>

    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="row g-3">

            <!-- Light Logo -->
            <div class="col-md-4 text-center">
                <label class="form-label">Light Logo</label>
                <div class="mb-2">
                    <img src="{{ $light_logo ? $light_logo->temporaryUrl() : ($current_light_logo ? asset('storage/' . $current_light_logo) : url('assets/frontend/images/default-logo.png')) }}"
                        alt="Light Logo" class="img-fluid mb-2" style="max-height:100px;">
                </div>
                <input type="file" wire:model="light_logo" class="form-control">
                @error('light_logo') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Dark Logo -->
            <div class="col-md-4 text-center">
                <label class="form-label">Dark Logo</label>
                <div class="mb-2">
                    <img src="{{ $dark_logo ? $dark_logo->temporaryUrl() : ($current_dark_logo ? asset('storage/' . $current_dark_logo) : url('assets/frontend/images/default-logo-dark.png')) }}"
                        alt="Dark Logo" class="img-fluid mb-2" style="max-height:100px;">
                </div>
                <input type="file" wire:model="dark_logo" class="form-control">
                @error('dark_logo') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Favicon -->
            <div class="col-md-4 text-center">
                <label class="form-label">Favicon</label>
                <div class="mb-2">
                    <img src="{{ $favicon ? $favicon->temporaryUrl() : ($current_favicon ? asset('storage/' . $current_favicon) : url('assets/frontend/images/favicon.png')) }}"
                        alt="Favicon" class="img-fluid mb-2" style="max-height:64px;">
                </div>
                <input type="file" wire:model="favicon" class="form-control">
                @error('favicon') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-12 text-end mt-3">
                <button type="submit" class="btn btn-primary">Save Logos & Favicon</button>
            </div>
        </div>
    </form>
</div>