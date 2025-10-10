<div class="card p-4">
    <h5 class="mb-4">Manage Banner</h5>

    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="row g-3">
            <!-- Heading -->
            <div class="col-md-6">
                <label for="heading" class="form-label">Heading</label>
                <input type="text" id="heading" class="form-control" wire:model="heading">
                @error('heading') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Highlight -->
            <div class="col-md-6">
                <label for="highlight" class="form-label">Highlight Text</label>
                <input type="text" id="highlight" class="form-control" wire:model="highlight">
                @error('highlight') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" class="form-control" wire:model="description" rows="3"></textarea>
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Button Text -->
            <div class="col-md-6">
                <label for="button_text" class="form-label">Button Text</label>
                <input type="text" id="button_text" class="form-control" wire:model="button_text">
                @error('button_text') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Button Link -->
            <div class="col-md-6">
                <label for="button_link" class="form-label">Button Link</label>
                <input type="url" id="button_link" class="form-control" wire:model="button_link">
                @error('button_link') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Video Link -->
            <div class="col-12">
                <label for="video_link" class="form-label">Video Link</label>
                <input type="url" id="video_link" class="form-control" wire:model="video_link">
                @error('video_link') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <hr class="my-3">

            <!-- Image -->
            <div class="col-md-6 text-center">
                <label class="form-label">Image</label>
                <div class="mb-2">
                    <img src="{{ $image ? $image->temporaryUrl() : ($current_image ? asset('storage/' . $current_image) : 'https://via.placeholder.com/400x200.png?text=Image') }}"
                        alt="Image" class="img-fluid mb-2" style="max-height:150px;">
                </div>
                <div wire:loading wire:target="image" class="text-primary">Uploading...</div>
                <input type="file" wire:model="image" class="form-control">
                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Background Image -->
            <div class="col-md-6 text-center">
                <label class="form-label">Background Image</label>
                <div class="mb-2">
                    <img src="{{ $background_image ? $background_image->temporaryUrl() : ($current_background_image ? asset('storage/' . $current_background_image) : 'https://via.placeholder.com/1920x1080.png?text=Background') }}"
                        alt="Background Image" class="img-fluid mb-2" style="max-height:150px;">
                </div>
                <div wire:loading wire:target="background_image" class="text-primary">Uploading...</div>
                <input type="file" wire:model="background_image" class="form-control">
                @error('background_image') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="col-12 text-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <span wire:loading.remove wire:target="save">Update Banner</span>
                    <span wire:loading wire:target="save">Updating...</span>
                </button>
            </div>
        </div>
    </form>
</div>