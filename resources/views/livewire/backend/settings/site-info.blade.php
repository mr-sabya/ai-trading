<div class="card p-4">
    <h5 class="mb-4">Site Info</h5>
    <form wire:submit.prevent="save">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Website Name</label>
                <input type="text" wire:model="website_name" class="form-control @error('website_name') is-invalid @enderror">
                @error('website_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Tagline</label>
                <input type="text" wire:model="tagline" class="form-control @error('tagline') is-invalid @enderror">
                @error('tagline') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-12">
                <label class="form-label">Short Description</label>
                <textarea wire:model="short_description" class="form-control @error('short_description') is-invalid @enderror"></textarea>
                @error('short_description') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" wire:model="phone" class="form-control @error('phone') is-invalid @enderror">
                @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-12">
                <label class="form-label">Address</label>
                <textarea wire:model="address" class="form-control @error('address') is-invalid @enderror"></textarea>
                @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-12">
                <label class="form-label">Copyright</label>
                <input type="text" wire:model="copyright" class="form-control @error('copyright') is-invalid @enderror">
                @error('copyright') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-12 text-end mt-3">
                <button type="submit" class="btn btn-primary">Save Site Info</button>
            </div>
        </div>
    </form>
</div>