<div class="card p-4">
    <h5 class="mb-4">Additional Settings</h5>
    <form wire:submit.prevent="save">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Google Analytics</label>
                <textarea wire:model="google_analytics" class="form-control"></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Facebook Pixel</label>
                <textarea wire:model="facebook_pixel" class="form-control"></textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label">Timezone</label>
                <input type="text" wire:model="timezone" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Currency</label>
                <input type="text" wire:model="currency" class="form-control">
            </div>
            <div class="col-md-4 form-check mt-4">
                <input type="checkbox" wire:model="maintenance_mode" class="form-check-input" id="maintenanceMode">
                <label class="form-check-label" for="maintenanceMode">Maintenance Mode</label>
            </div>
            <div class="col-12 text-end mt-3">
                <button type="submit" class="btn btn-primary">Save Additional Settings</button>
            </div>
        </div>
    </form>
</div>