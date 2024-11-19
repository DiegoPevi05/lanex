<section id="services" class="w-full h-auto xl:min-h-screen bg-white text-body">
    <div class="relative w-full h-full padding flex flex-col justify-center items-center">
        <h2 class="font-bold text-primary-dark animation-element slide-in-up text-center">
            {{ __('messages.home.services.title') }}
        </h2>

        <div class="h-full w-full grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 grid-rows-2 gap-6 xl:gap-12 py-12 xl:p-12 animation-group">
            @foreach ($services as $service)
                <x-service-card
                    :id="$service['id']"
                    :name="$service['name']"
                    :description="$service['short_description']"
                    :icon="$service['icon']"
                />
            @endforeach
        </div>
    </div>
</section>
