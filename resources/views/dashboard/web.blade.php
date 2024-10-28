
@extends('layouts.dashboard')

@section('content-dashboard')

    <section id="dashboard_web" class="bg-gray-light h-full w-full flex flex-row gap-x-4 p-4">
        <div class="w-full h-full flex flex-col bg-white rounded-xl p-4 gap-y-2">
            <h4 class="font-bold text-primary-dark capitalize">{{ __('messages.dashboard.web.header') }}</h4>
            <label class="text-primary-dark">{{__('messages.dashboard.web.indications')}}</label>
            <div class="w-full flex flex-col gap-y-2 animation-group">

                <a id="web-content-option-reviews" href={{ route('dashboard_web_review') }} class="w-full h-auto bg-white rounded-xl border-2 border-gray-light flex flex-row justify-start items-center p-4 duration-300 transition-all hover:bg-primary group cursor-pointer active:scale-95 gap-x-2">
                    <span class="h-8 w-8 bg-transparent flex items-center justify-center text-secondary-dark p-1 group-hover:text-white active:scale-95 transiton-all duration-300  cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </span>
                    <p class="font-bold text-primary group-hover:text-white capitalize">{{ __('messages.dashboard.web.card.reviews') }}</p>
                </a>

                <a id="web-content-option-services" href={{ route('dashboard_web_service') }} class="w-full h-auto bg-white rounded-xl border-2 border-gray-light flex flex-row justify-start items-center p-4 duration-300 transition-all hover:bg-primary group cursor-pointer active:scale-95 gap-x-2">
                    <span class="h-8 w-8 bg-transparent flex items-center justify-center text-secondary-dark p-1 group-hover:text-white active:scale-95 transiton-all duration-300  cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                    </span>
                    <p class="font-bold text-primary group-hover:text-white capitalize">{{ __('messages.dashboard.web.card.services') }}</p>
                </a>

                <a id="web-content-option-suppliers" href={{ route('dashboard_web_supplier') }} class="w-full h-auto bg-white rounded-xl border-2 border-gray-light flex flex-row justify-start items-center p-4 duration-300 transition-all hover:bg-primary group cursor-pointer active:scale-95 gap-x-2">
                    <span class="h-8 w-8 bg-transparent flex items-center justify-center text-secondary-dark p-1 group-hover:text-white active:scale-95 transiton-all duration-300  cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-warehouse"><path d="M22 8.35V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.35A2 2 0 0 1 3.26 6.5l8-3.2a2 2 0 0 1 1.48 0l8 3.2A2 2 0 0 1 22 8.35Z"/><path d="M6 18h12"/><path d="M6 14h12"/><rect width="12" height="12" x="6" y="10"/></svg>
                    </span>
                    <p class="font-bold text-primary group-hover:text-white capitalize">{{ __('messages.dashboard.web.card.suppliers') }}</p>
                </a>

                <a id="web-content-option-products" href={{ route('dashboard_web_product') }} class="w-full h-auto bg-white rounded-xl border-2 border-gray-light flex flex-row justify-start items-center p-4 duration-300 transition-all hover:bg-primary group cursor-pointer active:scale-95 gap-x-2">

                    <span class="h-8 w-8 bg-transparent flex items-center justify-center text-secondary-dark p-1 group-hover:text-white active:scale-95 transiton-all duration-300  cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-2"><path d="M3 9h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9Z"/><path d="m3 9 2.45-4.9A2 2 0 0 1 7.24 3h9.52a2 2 0 0 1 1.8 1.1L21 9"/><path d="M12 3v6"/></svg>
                    </span>
                    <p class="font-bold text-primary group-hover:text-white capitalize">{{ __('messages.dashboard.web.card.products') }}</p>
                </a>
            </div>
        </div>
    </section>
@endsection
