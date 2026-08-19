<section id="pillars_section" class="w-full h-auto bg-white text-body">
    <div class="w-full h-auto padding flex flex-col items-center">
        <h5 class="text-primary text-center animation-element slide-in-up">
            {{ __('messages.about.pillars.header') }}
        </h5>
        <h2 class="font-bold text-primary-dark text-center animation-element slide-in-up">
            {{ __('messages.about.pillars.title') }}
        </h2>

        <div class="w-full grid grid-cols-1 sm:grid-cols-3 gap-y-10 gap-x-6 xl:gap-x-12 mt-12 animation-group">
            <div class="col-span-1 flex flex-col items-center text-center gap-y-4 animation-element slide-in-up">
                <div class="rounded-xl flex items-center justify-center w-20 h-20 bg-primary p-4">
                    <x-heroicon-o-book-open class="w-full h-full text-white" />
                </div>
                <h4 class="font-bold text-primary-dark">
                    {{ __('messages.about.pillars.items.knowledge.title') }}
                </h4>
                <p>
                    {{ __('messages.about.pillars.items.knowledge.content') }}
                </p>
            </div>

            <div class="col-span-1 flex flex-col items-center text-center gap-y-4 animation-element slide-in-up">
                <div class="rounded-xl flex items-center justify-center w-20 h-20 bg-primary p-4">
                    <x-heroicon-o-light-bulb class="w-full h-full text-white" />
                </div>
                <h4 class="font-bold text-primary-dark">
                    {{ __('messages.about.pillars.items.innovation.title') }}
                </h4>
                <p>
                    {{ __('messages.about.pillars.items.innovation.content') }}
                </p>
            </div>

            <div class="col-span-1 flex flex-col items-center text-center gap-y-4 animation-element slide-in-up">
                <div class="rounded-xl flex items-center justify-center w-20 h-20 bg-primary p-4">
                    <x-heroicon-o-cpu-chip class="w-full h-full text-white" />
                </div>
                <h4 class="font-bold text-primary-dark">
                    {{ __('messages.about.pillars.items.technology.title') }}
                </h4>
                <p>
                    {{ __('messages.about.pillars.items.technology.content') }}
                </p>
            </div>
        </div>
    </div>
</section>
