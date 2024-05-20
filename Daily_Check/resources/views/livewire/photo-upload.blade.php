<div>
    {{-- Photo Upload --}}
    <form wire:submit.prevent="upload">
        @csrf
        <div>
            <label for="photo">Choose a photo:</label>
            <input type="file" id="photo" wire:model="photo" required>
        </div>
        @error('photo') <span class="error">{{ $message }}</span> @enderror

        <!-- 入力フォーム -->
        <div>
            <label for="part">Part:</label>
            <input type="text" id="part" wire:model="part">
        </div>
        @error('part') <span class="error">{{ $message }}</span> @enderror

        <div>
            <label for="site_id">Site ID:</label>
            <input type="number" id="site_id" wire:model="site_id">
        </div>
        @error('site_id') <span class="error">{{ $message }}</span> @enderror

        <div>
            <label for="scheduled_id">Scheduled ID:</label>
            <input type="number" id="scheduled_id" wire:model="scheduled_id">
        </div>
        @error('scheduled_id') <span class="error">{{ $message }}</span> @enderror

        <div>
            <button type="submit">Upload</button>
        </div>
    </form>
    @if (session()->has('success'))
    <p>{{ session('success') }}</p>
    @endif
</div>
