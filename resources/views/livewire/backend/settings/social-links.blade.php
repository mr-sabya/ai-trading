<div class="card p-4">
    <h5 class="mb-4">Social Links</h5>
    <form wire:submit.prevent="save">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Facebook</label>
                <input type="url" wire:model="facebook" class="form-control @error('facebook') is-invalid @enderror">
                @error('facebook') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Instagram</label>
                <input type="url" wire:model="instagram" class="form-control @error('instagram') is-invalid @enderror">
                @error('instagram') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">LinkedIn</label>
                <input type="url" wire:model="linkedin" class="form-control @error('linkedin') is-invalid @enderror">
                @error('linkedin') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">YouTube</label>
                <input type="url" wire:model="youtube" class="form-control @error('youtube') is-invalid @enderror">
                @error('youtube') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Twitter</label>
                <input type="url" wire:model="twitter" class="form-control @error('twitter') is-invalid @enderror">
                @error('twitter') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-12 text-end mt-3">
                <button type="submit" class="btn btn-primary">Save Social Links</button>
            </div>
        </div>
    </form>
</div>