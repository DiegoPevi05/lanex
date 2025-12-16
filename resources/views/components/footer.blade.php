<!-- resources/views/components/navbar.blade.php -->
<footer id="footer" class="p-4 flex flex-col padding-x  text-secondary-dark">
    <div class="w-full h-auto grid grid-cols-1 sm:grid-cols-3 xl:grid-cols-4 gap-12 padding-y">
        <div class="col-span-1 flex flex-col gap-y-4 justify-start items-start">

            <a href="{{route('home')}}"  class="w-full h-auto flex flex-row items-center">
                <div class="w-[60px] h-auto p-none">
                    <img src="/images/logo.png" alt="logo" class="h-auto w-full" />
                </div>
                <div class="w-auto flex flex-row">
                    <h2 class="font-bold text-primary">
                        Lan
                    </h2>
                    <h2 class="font-bold text-primary-dark">
                        Ex
                    </h2>
                </div>
            </a>
            <p class="text-justify">{{ __('messages.footer.caption') }}</p>
            <div class="flex flex-row gap-x-4">
                <a href="https://www.linkedin.com/company/expresslane-logistics-s-a-c/" target="_blank"
            aria-label="{{  __('messages.aria_labels.linkedin') }}"
            title="{{ __('messages.titles.linkedin') }}"
                    >
                    <x-bi-linkedin class="w-8 h-8" />
                </a>
                <a href="https://www.facebook.com/profile.php?id=61566765038948" target="_blank"

            aria-label="{{  __('messages.aria_labels.facebook') }}"
            title="{{ __('messages.titles.facebook') }}"
                    >
                    <x-bi-facebook class="w-8 h-8" />
                </a>
                <a href="https://www.instagram.com/expresslanelogisticssac" target="_blank"

            aria-label="{{  __('messages.aria_labels.instagram') }}"
            title="{{ __('messages.titles.instagram') }}"
                    >
                    <x-bi-instagram class="w-8 h-8"/>
                </a>
                <a href="https://www.tiktok.com/@expresslanelogisticssac" target="_blank"

            aria-label="{{  __('messages.aria_labels.tiktok') }}"
            title="{{ __('messages.titles.tiktok') }}"
                    >
                    <x-bi-tiktok class="w-8 h-8"/>
                </a>
            </div>
        </div>

        <div class="col-span-1 flex flex-col gap-y-4 justify-start item-start sm:items-center">
            <span class="font-bold">{{ __('messages.footer.navigation') }}</span>
            <div class="flex flex-col justify-start items-start gap-y-4">
                <span><a href="{{ route('home') }}"
                        class="hover:underline"
                        aria-label="{{ __('messages.aria_labels.home') }}"
                        title="{{ __('messages.titles.home') }}"
                        >{{ __('messages.navbar.home') }}</a></span>
                <span><a href="{{ route('about') }}" class="hover:underline"
                aria-label="{{ __('messages.aria_labels.aboutus') }}"
                title="{{ __('messages.titles.aboutus') }}"
                        >{{ __('messages.navbar.aboutus') }}</a></span>
                <span><a href="{{ route('services') }}" class="hover:underline"
                aria-label="{{ __('messages.aria_labels.services') }}"
                title="{{ __('messages.titles.services') }}"
                        >{{ __('messages.navbar.services') }}</a></span>
                <span><a href="{{ route('contact') }}" class="hover:underline"
                aria-label="{{ __('messages.aria_labels.contactus') }}"
                title="{{ __('messages.titles.contactus') }}"
                        >{{ __('messages.navbar.contact') }}</a></span>
            </div>
        </div>

        <div class="hidden col-span-1 xl:flex flex-col gap-y-4 justify-start items-start">

            <span class="font-bold">{{ __('messages.footer.projects') }}</span>
            <a href="{{ route('services') }}" class="w-full h-full rounded-xl relative flex items-center justify-center hover:cursor-pointer group overflow-hidden"
                aria-label="{{ __('messages.aria_labels.services') }}"
                title="{{ __('messages.titles.services') }}"
                >
                <div class="absolute top-0 left-0 w-full h-full rounded-xl bg-center bg-cover bg-no-repeat z-[20] group-hover:scale-[1.2] transition-all duration-300" style="background-image: url('{{ asset('storage/images/web/cosco.webp') }}');">
                </div>
                <div class="absolute top-0 left-0 w-full h-full rounded-xl z-[40]" style="background-color: rgba(0,0,0,0.2);">
                </div>
                <h5 class="z-50 font-bold text-primary text-white group-hover:text-secondary">{{ __('messages.footer.projects_send') }}</h5>
            </a>
        </div>

        <div class="hidden sm:flex col-span-1 flex-col gap-y-4 justify-start items-start">
            <span class="font-bold">{{ __('messages.footer.subscribe') }}</span>

            <form action="{{ route('subscribe.submit') }}" method="POST" class="w-full flex flex-col gap-y-4">
                @csrf

                <input
                    name="email"
                    type="email"
                    required
                    placeholder="{{ __('messages.footer.subscribe_placeholder') }}"
                    class="w-full bg-body border-2 border-body rounded-md p-4 text-sm placeholder:text-secondary text-secondary"
                />

                <button
                    type="submit"
                    class="uppercase py-4 w-full font-bold rounded-md bg-primary-dark text-white hover:bg-secondary-dark duration-300 active:scale-95"
                >
                    {{ __('messages.footer.subscribe_btn') }}
                </button>
            </form>
        </div>
    </div>
    <div class="w-full h-auto flex flex-col justify-start items-start border-t-2 border-secondary-dark border-dashed gap-y-2">
        <label class="font-bold mt-6 text-secodnary">Copyright © {{$currentYear}} Lan<label class="text-primary-dark">Ex</label></label>
        <div class="w-full h-full flex flex-col items-center justify-end pb-3">
            <label>{{ __('messages.footer.developed_by') }} <a href="https://www.digitalprocessit.com" target="_blank" class="hover:text-primary hover:underline duration-300">DigitalProcessIT</a> © {{$currentYear}} </label>
        </div>
    </div>
</footer>

 <script>
    document.addEventListener("DOMContentLoaded", function () {

        @if(session('success'))
            showToast(["{{session('success')}}"]);
        @endif

        @if($errors->any())
            showToast(@json($errors->all()));
        @endif

        @if(session('error'))
            showToast(["{{session('error')}}"]);
        @endif

    });
</script>
