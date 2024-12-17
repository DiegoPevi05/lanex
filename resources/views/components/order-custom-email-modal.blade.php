<div id="modal_custom_email_component" class="modal_component animation-element no-delay pointer-events-none fixed h-screen w-screen top-0 bottom-0 left-0 right-0 z-[1500] flex items-center justify-center" style="background-color:rgba(0, 0, 0, 0.5);">
    <form class="modal_content bg-white h-auto max-sm:mx-4 sm:min-h-[200px] sm:min-w-[400px] p-4 rounded-xl relative flex flex-col items-center justify-center p-4 sm:p-12 gap-y-4" action="#" method="POST"  enctype="multipart/form-data">

        @csrf <!-- Include CSRF token for security -->
        @method('POST') <!-- Specify DELETE method for deleting -->
        <span id="status_modal" class="absolute top-2 right-2 cursor-pointer text-gray-500 hover:text-red-500">✖</span>

        <span class="text-primary h-20 w-20">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        </span>

        <label id="title_modal" class="title_modal font-bold text-xl text-primary mb-4 text-center">
            {{ __('messages.mail.modal.custom_email_header') }}
        </label>
        <p id="content_modal" class="content_modal text-gray-700 text-md text-center">
            {{ __('messages.mail.modal.custom_email_subheader') }}
        </p>

        <div class="w-full h-auto flex flex-col">
            <label for="email_subject" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.mail.modal.custom_email_subject') }}:</label>
            <input type="text" id="email_subject" name="email_subject" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __('messages.mail.modal.custom_email_subject_placeholder') }}">
        </div>

        <div class="w-full h-auto flex flex-col">
            <label for="email_title" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.mail.modal.custom_email_title') }}:</label>
            <input type="text" id="email_title" name="email_title" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __('messages.mail.modal.custom_email_title_placeholder') }}">
        </div>

        <div class="w-full h-auto flex flex-col">
            <label for="email_content" class="block text-sm font-bold text-secondary-dark capitalize">{{ __('messages.mail.modal.custom_email_content') }}:</label>
            <textarea type="text" id="email_content" name="email_content" class="text-sm mt-1 block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __('messages.mail.modal.custom_email_content_placeholder') }}"></textarea>
        </div>

        <div class="w-full flex flex-row justify-center items-start gap-x-4">
            <p class="text-md text-body font-bold">{{ __('messages.mail.modal.custom_email_details') }}</p>
            <div class="checkbox-wrapper-2">
              <input type="checkbox" class="sc-gJwTLC ikxBAC" id="email_order_details" name="email_order_details">
            </div>
        </div>


        <label id="file_title_modal" class="font-bold text-primary text-center animation-element slide-in-up">{{ __('messages.mail.modal.pdf_message') }}</label>
        <input id="pdf-archive" name="pdf-archive" type="file" class="upload-file-input animation-element slide-in-up"/>

        <div class="h-auto w-auto gap-x-4 flex justify-between">
            <button id="cancel_status_btn" onclick="closeOrderCustomEmailModal()" type="button"  class="w-auto h-full py-2 px-6 bg-primary capitalize text-white rounded-xl active:scale-95 hover:bg-secondary-dark duration-300 font-bold inline-flex items-center gap-x-2 text-lg">
                {{__('messages.common.cancel')}}
            </button>
            <button id="send_status_btn" type="submit" class="w-auto h-full py-2 px-6 bg-primary capitalize text-white rounded-xl active:scale-95 hover:bg-secondary-dark duration-300 font-bold inline-flex items-center gap-x-2 text-lg">
                <p id="send_status_btn_label" class="h-full text-lg"> {{ __('messages.mail.modal.custom_email_btn_msg') }}</p>
                <span id="loader_status_spinner" class="w-6 h-6 hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="animate-spin lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                </span>
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function showOrderCustomEmailModal(order_id, urlAction) {
        const modal = document.getElementById("modal_custom_email_component");

        // Show the modal
        modal.classList.remove("pointer-events-none", "fade-out");
        modal.classList.add("fade-in");

        const statusButton = modal.querySelector("#status_modal");
        statusButton.addEventListener("click", () => closeOrderCustomEmailModal());


        const form = modal.querySelector('.modal_content');

        form.action = urlAction;

    };



    function closeOrderCustomEmailModal() {
        // Fade out the modal and hide after animation

        const modal = document.getElementById("modal_custom_email_component");

        modal.classList.add("pointer-events-none");
        modal.classList.add("fade-out");
        modal.classList.remove("fade-in");
    };

</script>
@endpush
