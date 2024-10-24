<div class="w-full h-full">
    <h5>{{ $formRequest !== 'view' ? ($formRequest === 'update' ? 'Update Review' : 'Create Review') : "View Review"  }}</h5>

    <form method="{{ $formRequest !== 'view' ? ($formRequest === 'create' ? 'POST' : 'PUT') : '#' }}" action="{{ $formRequest !== 'view' ? ($formRequest === 'update' ? route('reviews.update', $review->id) : route('reviews.store')) : '#' }}">
        @csrf
        @if($review)
            @method('PUT')
        @endif

        <!-- Name Field -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ old('name', $review->name ?? '') }}">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Charge Field -->
        <div class="mb-4">
            <label for="charge" class="block text-sm font-medium text-gray-700">Charge</label>
            <input type="text" id="charge" name="charge" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ old('charge', $review->charge ?? '') }}">
            @error('charge')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Date of Review Field -->
        <div class="mb-4">
            <label for="date_review" class="block text-sm font-medium text-gray-700">Date of Review</label>
            <input type="date" id="date_review" name="date_review" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ old('date_review', $review->date_review ?? '') }}">
            @error('date_review')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Review Text Field -->
        <div class="mb-4">
            <label for="review" class="block text-sm font-medium text-gray-700">Review</label>
            <textarea id="review" name="review" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">{{ old('review', $review->review ?? '') }}</textarea>
            @error('review')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Stars Field -->
        <div class="mb-4">
            <label for="stars" class="block text-sm font-medium text-gray-700">Stars</label>
            <input type="number" id="stars" name="stars" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" min="1" max="5" value="{{ old('stars', $review->stars ?? '') }}">
            @error('stars')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md">
                {{ $review ? 'Update' : 'Create' }} Review
            </button>
        </div>
    </form>
</div>
