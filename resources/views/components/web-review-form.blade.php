<div class="w-full h-full">
    <h5 class="font-bold text-primary capitalize">{{ $formRequest !== 'view' ? ($formRequest === 'update' ? __("messages.dashboard.web.review.form.headers.update") : __("messages.dashboard.web.review.form.headers.create")) : __("messages.dashboard.web.review.form.headers.view")  }}</h5>

    <div id="review-form">
        <!-- Name Field -->
        <div class="mb-4 mt-4">
            <label for="name" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.review.form.fields.name") }}</label>
            <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('name', $review->name ?? '') }}" placeholder="{{ __("messages.dashboard.web.review.form.placeholders.name") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-red-500 text-sm error-message" id="error-name"></span>
        </div>

        <!-- Charge Field -->
        <div class="mb-4">
            <label for="charge" class="block text-sm font-bold text-secondary-dark capitalize"> {{ __('messages.dashboard.web.review.form.fields.charge') }}</label>
            <input type="text" id="charge" name="charge" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('charge', $review->charge ?? '') }}" placeholder="{{ __("messages.dashboard.web.review.form.placeholders.charge") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-red-500 text-sm error-message" id="error-charge"></span>
        </div>

        <!-- Date of Review Field -->
        <div class="mb-4">
            <label for="date_review" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.review.form.fields.date_review') }}</label>
            <input type="date" id="date_review" name="date_review" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('date_review', optional($review)->date_review ? \Carbon\Carbon::parse($review->date_review)->format('Y-m-d') : '') }}" placeholder="{{ __("messages.dashboard.web.review.form.placeholders.date_review") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-red-500 text-sm error-message" id="error-date_review"></span>
        </div>

        <!-- Review Text Field -->
        <div class="mb-4">
            <label for="review" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.review.form.fields.review') }}</label>
            <textarea id="review" name="review" rows="4" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.review.form.placeholders.review") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old('review', $review->review ?? '') }}</textarea>
            <span class="text-red-500 text-sm error-message" id="error-review"></span>
        </div>

        <!-- Stars Field -->
        <div class="mb-4">
            <label for="stars" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.web.review.form.fields.stars') }}</label>
            <input type="number" id="stars" name="stars" class="mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" min="1" max="5" value="{{ old('stars', $review->stars ?? '') }}"  placeholder="{{ __("messages.dashboard.web.review.form.placeholders.stars") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-red-500 text-sm error-message" id="error-stars"></span>
        </div>

        <!-- Submit Button -->
        <div class="flex {{ $formRequest == "view" ? 'justify-end' : 'justify-between' }} ">
            <button onclick="clearContent()" type="button" class="px-4 py-2 bg-secondary-dark text-white duration-300 hover:bg-primary rounded-md active:scale-95 capitalize">
                <p>
                    {{ __('messages.dashboard.web.review.form.buttons.cancel') }}
                </p>
            </button>
            @if($formRequest != 'view')
                <button id="submit-button"  class="px-4 py-2 bg-primary text-white duration-300 hover:bg-primary-dark rounded-md active:scale-95 capitalize">
                    {{ $formRequest == "update" ? __('messages.dashboard.web.review.form.buttons.update') : __('messages.dashboard.web.review.form.buttons.create') }}
                </button>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to handle form submission
        function handleFormSubmit() {
            console.log("Form submission function called");
            const form = document.getElementById('review-form');
            const formData = new FormData(form);

            console.log("Form submission intercepted");  // Check if this is logged
            return;

            const formAction = '{{ $formRequest == "update" ? route("reviews.update", $review->id) : route("reviews.store") }}';
            const method = '{{ $formRequest == "update" ? "PUT" : "POST" }}';

            fetch(formAction, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);  // Handle success
                } else {
                    const errorFields = ['name', 'charge', 'date_review', 'review', 'stars'];
                    errorFields.forEach(field => {
                        const errorSpan = document.getElementById(`error-${field}`);
                        errorSpan.textContent = data.errors[field] ? data.errors[field][0] : '';
                    });
                }
            })
            .catch(error => console.error('Error:', error));  // Handle errors
        }

        // Attach the handleFormSubmit function to the form's submit event
        const submitButton = document.getElementById('submit-button');
        submitButton.addEventListener('click', handleFormSubmit);

    });
</script>
