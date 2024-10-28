@extends('layouts.client')


@section('content-client')
    <section id="quote_hero_section" class="w-full h-auto bg-white text-body pt-[80px] pt:mt-[140px]">
    <div class="relative w-full h-auto px-4 sm:px-24 xl:px-48 py-12 sm:py-24 xl:py-36 flex flex-col-reverse xl:flex-row justify-start items-start gap-y-6 sm:gap-x-12 xl:gap-x-24 animation-group">
        <div class="w-full xl:w-1/2 h-full flex flex-col justify-start xl:justify-center items-start gap-y-6">
            <form class="w-full h-full border-2 border-gray-light rounded-xl flex flex-col justify-start items-start px-4 py-6 sm:p-6 gap-y-6 text-primary-dark animation-element slide-in-up">
                <h5>
                    {{__('messages.quote.form.quote_form_title')}}
                </h5>
                <div class="w-full h-auto grid grid-cols-2 gap-6 mt-6 ">
                    <div class="col-span-1 h-auto flex flex-col ">
                        <div class="flex flex-col w-full h-auto">
                            <label for="quote_form_number_flight" class="flex flex-row w-full h-auto gap-x-2">
                                <x-bi-airplane-fill class="text-primary h-6 w-6"/>
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
                                <x-mdi-package-variant-closed class="text-primary h-6 w-6"/>
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
                                <x-bi-calendar class="text-primary h-6 w-6"/>
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
                                <x-bi-calendar-check class="text-primary h-6 w-6"/>
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
                                <x-heroicon-s-home class="text-primary h-6 w-6"/>
                                <p class="font-bold text-secondary-dark">
                                    {{__('messages.quote.form.quote_form_arrival_address_label')}}
                                </p>
                            </label>
                            <input id="quote_form_arrival_address" name="arrival_date" type="text"  class="w-full h-auto py-2 px-4 border-b-2 border-secondary-dark text-secondary-dark placeholder:text-secondary-dark focus:border-b-2 focus:border-primary focus:outline-none" placeholder="{{__('messages.quote.form.quote_form_arrival_address_placeholder')}}" />
                        </div>

                    </div>
                    <div class="col-span-1 h-auto flex flex-col ">
                        <div class="flex flex-col w-full h-auto">
                            <label for="quote_form_supplier_identifier" class="flex flex-row w-full h-auto gap-x-2">
                                <x-bi-building class="text-primary h-6 w-6"/>
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
                                <x-bi-building class="text-primary h-6 w-6"/>
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
                                <x-mdi-package-variant-closed class="text-primary h-6 w-6"/>
                                <p class="font-bold text-secondary-dark">
                                    {{__('messages.quote.form.quote_form_product_identificator_label')}}
                                </p>
                            </label>
                            <input id="quote_form_product_identifier" name="product_identifier" type="text"  class="w-full h-auto py-2 px-4 border-b-2 border-secondary-dark text-secondary-dark placeholder:text-secondary-dark focus:border-b-2 focus:border-primary focus:outline-none" placeholder="{{__('messages.quote.form.quote_form_product_identificator_placeholder')}}" />
                        </div>
                    </div>
                </div>
                <div class="w-full h-auto">
                    <label for="quote_form_email" class="font-bold">{{__('messages.quote.form.quote_form_email_label')}}</span>
                    <input id="quote_form_email" name="email" type="email"  class="w-full h-auto p-4 border-2 border-secondary-dark rounded-lg text-secondary-dark placeholder:text-secondary-dark mt-4 focus:border-2 focus:border-primary focus:outline-none" placeholder="{{__('messages.quote.form.quote_form_email_placeholder')}}" />
                </div>
                <div class="w-full h-auto">
                    <label for="quote_form_message" class="font-bold">{{__('messages.quote.form.quote_form_message_label')}}</span>
                    <textarea id="quote_form_message" name="message"  class="w-full h-auto p-4 border-2 border-secondary-dark rounded-lg text-secondary-dark placeholder:text-secondary-dark mt-4 focus:border-2 focus:border-primary focus:outline-none" >{{__('messages.quote.form.quote_form_message_placeholder')}}</textarea>
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
                    <img src="{{asset('storage'.'/images/web/quote.svg')}}" class="h-48 sm:h-96 w-auto" />
                </div>
            </div>
        </div>
    </div>
    </section>
    <x-questions title="{{__('messages.quote.questions')}}" :questions="$questions" />
@endsection
