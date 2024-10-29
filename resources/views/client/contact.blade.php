@extends('layouts.client')


@section('content-client')
    <section id="contact_hero_section" class="w-full h-auto bg-white text-body pt-[80px] pt:mt-[140px]">
    <div class="relative w-full h-auto px-4 sm:px-24 xl:px-48 py-12 sm:py-24 xl:py-36 flex flex-col xl:flex-row justify-start items-start gap-y-6 sm:gap-x-12 xl:gap-x-24 animation-group">
        <div class="w-full xl:w-1/2 h-full flex flex-col justify-start items-start gap-y-6 max-sm:mt-12">
            <div class="h-auto h-full w-full flex flex-col justify-start items-start relative">
                <h5 class="animation-element slide-in-up">
                    {{ __('messages.contact.hero.header') }}
                </h5>
                <h1 class="text-primary-dark font-bold animation-element slide-in-up">
                    {{ __('messages.contact.hero.title') }}
                </h1>
                <div class="w-full h-full flex justify-center items-center p-6 sm:p-4 mt-6 sm:mt-12 animation-element slide-in-up">
                    <img src="{{asset('storage/'.'images/web/contact.svg')}}" class="h-48 sm:h-96 w-auto" />
                </div>
            </div>
        </div>

        <div class="w-full xl:w-1/2 h-full flex flex-col justify-start xl:justify-center items-start gap-y-6">
            <form action="{{ route('contact.submit') }}" method="POST" class="w-full h-full border-2 border-gray-light rounded-xl flex flex-col justify-start items-start px-4 py-6 sm:p-6 gap-y-6 text-primary-dark animation-element slide-in-up">
                @csrf
                <h5>
                    {{ __('messages.contact.hero.form.contact_form_title') }}
                </h5>
                <div class="w-full h-auto">
                    <label for="contact_form_email" class="font-bold">{{ __('messages.contact.hero.form.contact_form_email_label') }}</span>
                    <input id="contact_form_email" name="email" type="email"  class="w-full h-auto p-4 border-2 border-secondary-dark rounded-lg text-secondary-dark placeholder:text-secondary-dark mt-4 focus:border-2 focus:border-primary focus:outline-none" placeholder="{{ __('messages.contact.hero.form.contact_form_email_placeholder') }}" />
                </div>

                <div class="w-full h-auto">
                    <label for="contact_form_company" class="font-bold">{{ __('messages.contact.hero.form.contact_form_company_label') }}</span>
                    <input id="contact_form_company" name="company" type="text"  class="w-full h-auto p-4 border-2 border-secondary-dark rounded-lg text-secondary-dark placeholder:text-secondary-dark mt-4 focus:border-2 focus:border-primary focus:outline-none" placeholder="{{ __('messages.contact.hero.form.contact_form_company_placeholder') }}" />
                </div>

                <div class="w-full h-auto">
                    <label for="contact_form_ruc" class="font-bold">{{ __('messages.contact.hero.form.contact_form_ruc_label') }}</span>
                    <input id="contact_form_ruc" name="ruc" type="text"  class="w-full h-auto p-4 border-2 border-secondary-dark rounded-lg text-secondary-dark placeholder:text-secondary-dark mt-4 focus:border-2 focus:border-primary focus:outline-none" placeholder="{{ __('messages.contact.hero.form.contact_form_ruc_placeholder') }}" />
                </div>
                <div class="w-full h-auto">
                    <label for="contact_form_message" class="font-bold">{{ __('messages.contact.hero.form.contact_form_message_label') }}</span>
                    <textarea id="contact_form_message" name="message"  class="w-full h-auto p-4 border-2 border-secondary-dark rounded-lg text-secondary-dark placeholder:text-secondary-dark mt-4 focus:border-2 focus:border-primary focus:outline-none" placeholder="{{ __('messages.contact.hero.form.contact_form_message_placeholder') }}"></textarea>
                </div>
                <button type="submit" class="bg-primary-dark px-12 sm:px-24 py-2 sm:py-4 lg:py-3 text-white font-bold duration-300 active:scale-95 rounded-xl hover:bg-secondary-dark mx-auto">
                    <span>{{ __('messages.contact.hero.form.contact_form_button') }}</span>
                </button>
            </form>
        </div>
    </div>
    </section>
    <x-questions title="{{ __('messages.contact.questions') }}" :questions="$questions" />
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
