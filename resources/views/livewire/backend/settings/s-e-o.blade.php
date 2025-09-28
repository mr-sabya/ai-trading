<div class="card p-4">
    <h5 class="mb-4">SEO Settings</h5>
    <form wire:submit.prevent="save">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Meta Title</label>
                <input type="text" wire:model="meta_title" class="form-control @error('meta_title') is-invalid @enderror">
                @error('meta_title') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-12">
                <label class="form-label">Meta Keywords</label>
                <textarea wire:model="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror"></textarea>
                @error('meta_keywords') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-12">
                <label class="form-label">Meta Description</label>
                <textarea wire:model="meta_description" class="form-control @error('meta_description') is-invalid @enderror"></textarea>
                @error('meta_description') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="col-12 text-end mt-3">
                <button type="submit" class="btn btn-primary">Save SEO Settings</button>
            </div>
        </div>
    </form>
</div>