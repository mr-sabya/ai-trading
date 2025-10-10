<div class="card p-4">
    <h5 class="mb-4">Manage "About Us" Section</h5>

    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="row g-3">
            <!-- Title -->
            <div class="col-md-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" class="form-control" wire:model="title" placeholder="e.g., Meet our company">
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Highlight -->
            <div class="col-md-6">
                <label for="highlight" class="form-label">Highlight Text</label>
                <input type="text" id="highlight" class="form-control" wire:model="highlight" placeholder="e.g., our company">
                @error('highlight') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Subtitle -->
            <div class="col-12">
                <label for="subtitle" class="form-label">Subtitle</label>
                <input type="text" id="subtitle" class="form-control" wire:model="subtitle" placeholder="e.g., unless miss the opportunity">
                @error('subtitle') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" class="form-control" wire:model="description" rows="4"></textarea>
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

            <hr class="my-3">

            <!-- Experience Years Label -->
            <div class="col-md-6">
                <label for="exp_years_label" class="form-label">Experience Label</label>
                <input type="text" id="exp_years_label" class="form-control" wire:model="exp_years_label" placeholder="e.g., Years of Experience">
                @error('exp_years_label') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Experience Years Value -->
            <div class="col-md-6">
                <label for="exp_years_value" class="form-label">Experience Value</label>
                <input type="number" id="exp_years_value" class="form-control" wire:model="exp_years_value" placeholder="e.g., 10">
                @error('exp_years_value') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Customers Label -->
            <div class="col-md-6">
                <label for="customers_label" class="form-label">Customers Label</label>
                <input type="text" id="customers_label" class="form-control" wire:model="customers_label" placeholder="e.g., Happy Customers">
                @error('customers_label') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Customers Value -->
            <div class="col-md-6">
                <label for="customers_value" class="form-label">Customers Value</label>
                <input type="text" id="customers_value" class="form-control" wire:model="customers_value" placeholder="e.g., 5k+">
                @error('customers_value') <span class="text-danger">{{ $message }}</span> @enderror
            </div>


            <hr class="my-3">

            <!-- Image -->
            <div class="col-12 text-center">
                <label class="form-label">Image</label>
                <div class="mb-2">
                    <img src="{{ $image ? $image->temporaryUrl() : ($current_image ? asset('storage/' . $current_image) : 'https://via.placeholder.com/400x300.png?text=About+Image') }}"
                        alt="Image" class="img-fluid mb-2" style="max-height:200px;">
                </div>
                <div wire:loading wire:target="image" class="text-primary">Uploading...</div>
                <input type="file" wire:model="image" class="form-control" style="max-width: 400px; margin: auto;">
                @error('image') <span class="text-danger d-block mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="col-12 text-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <span wire:loading.remove wire:target="save">Update "About Us"</span>
                    <span wire:loading wire:target="save">Updating...</span>
                </button>
            </div>
        </div>
    </form>
</div>