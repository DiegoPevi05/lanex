@section('meta_description', __('messages.meta.quote'))
@extends('layouts.client')


@section('content-client')
    <section id="quote_hero_section" class="w-full h-auto bg-white text-body pt-[80px] pt:mt-[140px]">
    <div class="relative w-full h-auto px-4 sm:px-24 xl:px-48 py-12 sm:py-24 xl:py-36 flex flex-col-reverse xl:flex-row justify-start items-start gap-y-6 sm:gap-x-12 xl:gap-x-24 animation-group">
        <div class="w-full xl:w-1/2 h-full flex flex-col justify-start xl:justify-center items-start gap-y-6">
            <form action="{{route('quote.submit')}}" method="POST" class="w-full h-full border-2 border-gray-light rounded-xl flex flex-col justify-start items-start px-4 py-6 sm:p-6 gap-y-6 text-primary-dark animation-element slide-in-up">
                @csrf
                <h5>
                    {{__('messages.quote.form.quote_form_title')}}
                </h5>
                <div class="w-full h-auto grid grid-cols-2 gap-6 mt-6 ">
                    <div class="col-span-1 h-auto flex flex-col ">
                        <div class="flex flex-col w-full h-auto">
                            <label for="quote_form_number_flight" class="flex flex-row w-full h-auto gap-x-2">
                                <span class="text-primary h-6 w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plane"><path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/></svg>
                                </span>
                                <p class="font-bold text-secondary-dark">
                                    {{__('messages.quote.form.quote_form_number_flight_label')}}
                                </p>
                            </label>
                            <input id="quote_form_number_flight" name="number_flight" type="text"  class="w-full h-auto py-2 px-4 border-b-2 border-secondary-dark text-secondary-dark placeholder:text-secondary-dark focus:border-b-2 focus:border-primary focus:outline-none" placeholder="{{__('messages.quote.form.quote_form_number_flight_placeholder')}}" />
                        </div>

                    </div>
                    <div class="col-span-1 h-auto flex flex-col ">
                        <div class="flex flex-col w-full h-auto">
                            <label for="quote_form_packing_list" class="flex flex-row w-full h-auto gap-x-2">
                                <span class="text-primary h-6 w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"/><path d="M12 22V12"/><path d="m3.3 7 7.703 4.734a2 2 0 0 0 1.994 0L20.7 7"/><path d="m7.5 4.27 9 5.15"/></svg>
                                </span>
                                <p class="font-bold text-secondary-dark">

                                    Packing List
                                </p>
                            </label>
                            <input id="quote_form_packing_list" name="packing_list" type="text"  class="w-full h-auto py-2 px-4 border-b-2 border-secondary-dark text-secondary-dark placeholder:text-secondary-dark focus:border-b-2 focus:border-primary focus:outline-none" placeholder="Packing List" />
                        </div>
                    </div>
                    <div class="col-span-1 h-auto flex flex-col ">
                        <div class="flex flex-col w-full h-auto">
                            <label for="quote_form_departure_date" class="flex flex-row w-full h-auto gap-x-2">
                                <span class="text-primary h-6 w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-arrow-up"><path d="m14 18 4-4 4 4"/><path d="M16 2v4"/><path d="M18 22v-8"/><path d="M21 11.343V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h9"/><path d="M3 10h18"/><path d="M8 2v4"/></svg>
                                </span>
                                <p class="font-bold text-secondary-dark">
                                    {{__('messages.quote.form.quote_form_departure_date_label')}}
                                </p>
                            </label>

                            <input id="quote_form_departure_date" name="departure_date" type="date"  class="w-full h-auto py-2 px-4 border-b-2 border-secondary-dark text-secondary-dark placeholder:text-secondary-dark focus:border-b-2 focus:border-primary focus:outline-none" placeholder="{{__('messages.quote.form.quote_form_departure_date_placeholder')}}" />
                        </div>

                    </div>
                    <div class="col-span-1 h-auto flex flex-col ">
                        <div class="flex flex-col w-full h-auto">
                            <label for="quote_form_arrival_date" class="flex flex-row w-full h-auto gap-x-2">
                                <span class="text-primary h-6 w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-arrow-down"><path d="m14 18 4 4 4-4"/><path d="M16 2v4"/><path d="M18 14v8"/><path d="M21 11.354V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7.343"/><path d="M3 10h18"/><path d="M8 2v4"/></svg>
                                </span>
                                <p class="font-bold text-secondary-dark">
                                    {{__('messages.quote.form.quote_form_arrival_date_label')}}
                                </p>
                            </label>
                            <input id="quote_form_arrival_date" name="arrival_date" type="date"  class="w-full h-auto py-2 px-4 border-b-2 border-secondary-dark text-secondary-dark placeholder:text-secondary-dark focus:border-b-2 focus:border-primary focus:outline-none" placeholder="{{__('messages.quote.form.quote_form_arrival_date_placeholder')}}" />
                        </div>

                    </div>
                    <div class="col-span-1 h-auto flex flex-col ">
                        <div class="flex flex-col w-full h-auto">
                            <label for="quote_form_arrival_address" class="flex flex-row w-full h-auto gap-x-2">
                                <span class="text-primary h-6 w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                                </span>
                                <p class="font-bold text-secondary-dark">
                                    {{__('messages.quote.form.quote_form_arrival_address_label')}}
                                </p>
                            </label>
                            <input id="quote_form_arrival_address" name="arrival_address" type="text"  class="w-full h-auto py-2 px-4 border-b-2 border-secondary-dark text-secondary-dark placeholder:text-secondary-dark focus:border-b-2 focus:border-primary focus:outline-none" placeholder="{{__('messages.quote.form.quote_form_arrival_address_placeholder')}}" />
                        </div>

                    </div>
                    <div class="col-span-1 h-auto flex flex-col ">
                        <div class="flex flex-col w-full h-auto">
                            <label for="quote_form_supplier_identifier" class="flex flex-row w-full h-auto gap-x-2">
                                <span class="text-primary h-6 w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-warehouse"><path d="M22 8.35V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.35A2 2 0 0 1 3.26 6.5l8-3.2a2 2 0 0 1 1.48 0l8 3.2A2 2 0 0 1 22 8.35Z"/><path d="M6 18h12"/><path d="M6 14h12"/><rect width="12" height="12" x="6" y="10"/></svg>
                                </span>
                                <p class="font-bold text-secondary-dark">
                                    {{__('messages.quote.form.quote_form_supplier_identificator_label')}}
                                </p>
                            </label>
                            <input id="quote_form_supplier_identifier" name="supplier_identifier" type="text"  class="w-full h-auto py-2 px-4 border-b-2 border-secondary-dark text-secondary-dark placeholder:text-secondary-dark focus:border-b-2 focus:border-primary focus:outline-none" placeholder="{{__('messages.quote.form.quote_form_supplier_identificator_placeholder')}}" />
                        </div>

                    </div>

                    <div class="col-span-1 h-auto flex flex-col ">
                        <div class="flex flex-col w-full h-auto">
                            <label for="quote_form_client_identifier" class="flex flex-row w-full h-auto gap-x-2">
                                <span class="text-primary h-6 w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building-2"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>
                                </span>
                                <p class="font-bold text-secondary-dark">
                                    {{__('messages.quote.form.quote_form_client_identificator_label')}}
                                </p>
                            </label>
                            <input id="quote_form_client_identifier" name="client_identifier" type="text"  class="w-full h-auto py-2 px-4 border-b-2 border-secondary-dark text-secondary-dark placeholder:text-secondary-dark focus:border-b-2 focus:border-primary focus:outline-none" placeholder="{{__('messages.quote.form.quote_form_client_identificator_placeholder')}}" />
                        </div>

                    </div>

                    <div class="col-span-1 h-auto flex flex-col ">
                        <div class="flex flex-col w-full h-auto">

                            <label for="quote_form_product_identifier" class="flex flex-row w-full h-auto gap-x-2">
                                <span class="text-primary h-6 w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"/><path d="M12 22V12"/><path d="m3.3 7 7.703 4.734a2 2 0 0 0 1.994 0L20.7 7"/><path d="m7.5 4.27 9 5.15"/></svg>
                                </span>
                                <p class="font-bold text-secondary-dark">
                                    {{__('messages.quote.form.quote_form_product_identificator_label')}}
                                </p>
                            </label>
                            <input id="quote_form_product_identifier" name="product_identifier" type="text"  class="w-full h-auto py-2 px-4 border-b-2 border-secondary-dark text-secondary-dark placeholder:text-secondary-dark focus:border-b-2 focus:border-primary focus:outline-none" value="{{ $product ? $product->EAN : '' }}"  placeholder="{{__('messages.quote.form.quote_form_product_identificator_placeholder')}}" />
                        </div>
                    </div>
                </div>
                <div class="w-full h-auto">
                    <label for="quote_form_email" class="font-bold">{{__('messages.quote.form.quote_form_email_label')}}</span>
                    <input id="quote_form_email" name="email" type="email"  class="w-full h-auto p-4 border-2 border-secondary-dark rounded-lg text-secondary-dark placeholder:text-secondary-dark mt-4 focus:border-2 focus:border-primary focus:outline-none" placeholder="{{__('messages.quote.form.quote_form_email_placeholder')}}" />
                </div>
                <div class="w-full h-auto">
                    <label for="quote_form_message" class="font-bold">{{__('messages.quote.form.quote_form_message_label')}}</span>
                    <textarea id="quote_form_message" name="message"  class="w-full h-auto p-4 border-2 border-secondary-dark rounded-lg text-secondary-dark placeholder:text-secondary-dark mt-4 focus:border-2 focus:border-primary focus:outline-none" placeholder="{{__('messages.quote.form.quote_form_message_placeholder')}}"></textarea>
                </div>
                <button type="submit" class="bg-primary-dark px-12 sm:px-24 py-2 sm:py-4 lg:py-3 text-white font-bold duration-300 active:scale-95 rounded-xl hover:bg-secondary-dark mx-auto">
                    <span>{{__('messages.quote.form.quote_form_button')}}</span>
                </button>
            </form>
        </div>
        <div class="w-full xl:w-1/2 h-full flex flex-col justify-start items-start gap-y-6 max-sm:mt-12">
            <div class="h-auto h-full w-full flex flex-col justify-start items-end relative">
                <h5 class="animation-element slide-in-up text-right">
                    {{__('messages.quote.hero.header')}}
                </h5>
                <h1 class="text-primary-dark font-bold animation-element slide-in-up text-right">
                    {{__('messages.quote.hero.title')}}
                </h1>
                <div class="w-full h-full flex justify-center items-center p-6 sm:p-4 mt-6 sm:mt-12 animation-element slide-in-up">
                    <img src="{{asset('storage'.'/images/web/quote.svg')}}" alt="quote_hero_image" class="h-48 sm:h-96 w-auto" />
                </div>
            </div>
        </div>
    </div>
    </section>
    <x-questions title="{{__('messages.quote.questions.title')}}" :questions="$questions" />
@endsection

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
