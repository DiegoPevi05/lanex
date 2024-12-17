<div id="modal_status_component" class="modal_component animation-element no-delay pointer-events-none fixed h-screen w-screen top-0 bottom-0 left-0 right-0 z-[1500] flex items-center justify-center" style="background-color:rgba(0, 0, 0, 0.5);">
    <form class="modal_content bg-white h-auto max-sm:mx-4 sm:min-h-[200px] sm:min-w-[400px] p-4 rounded-xl relative flex flex-col items-center justify-center p-4 sm:p-12 gap-y-4" action="#" method="POST"  enctype="multipart/form-data">

        @csrf <!-- Include CSRF token for security -->
        @method('POST') <!-- Specify DELETE method for deleting -->
        <span id="status_modal" class="absolute top-2 right-2 cursor-pointer text-gray-500 hover:text-red-500">✖</span>

        <span class="text-primary h-20 w-20">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="animate-spin-reverse-slow w-full h-full"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 16h5v5"/></svg>
        </span>

        <label id="title_modal" class="title_modal font-bold text-xl text-primary mb-4 text-center">
            {{ __('messages.mail.modal.header') }}
        </label>
        <p id="content_modal" class="content_modal text-gray-700 text-md text-center">
            {{ __('messages.mail.modal.subheader') }}
        </p>

        <input id="order-step" name="step" class="hidden"/>
        <input id="order-status" name="status" class="hidden"/>

        <div class="w-full flex flex-row justify-center items-start gap-x-4">
            <p class="text-md text-body font-bold">{{ __('messages.mail.modal.email_notification') }}</p>
            <div class="checkbox-wrapper-2">
              <input type="checkbox" class="sc-gJwTLC ikxBAC" id="email-notification" name="email-notification">
            </div>
        </div>

        <label id="file_title_modal" class="font-bold text-primary text-center hidden animation-element slide-in-up">{{ __('messages.mail.modal.pdf_message') }}</label>
        <input id="pdf-archive" name="pdf-archive" type="file" class="upload-file-input hidden animation-element slide-in-up" disabled/>

        <div class="h-auto w-auto gap-x-4 flex justify-between">
            <button id="cancel_status_btn" onclick="closeOrderStatusModal()" type="button"  class="w-auto h-full py-2 px-6 bg-primary capitalize text-white rounded-xl active:scale-95 hover:bg-secondary-dark duration-300 font-bold inline-flex items-center gap-x-2 text-lg">
                {{__('messages.common.cancel')}}
            </button>
            <button id="send_status_btn" type="submit" class="w-auto h-full py-2 px-6 bg-primary capitalize text-white rounded-xl active:scale-95 hover:bg-secondary-dark duration-300 font-bold inline-flex items-center gap-x-2 text-lg">
                <p id="send_status_btn_label" class="h-full text-lg"> {{ __('messages.mail.modal.send_status') }}</p>
                <span id="loader_status_spinner" class="w-6 h-6 hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="animate-spin lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                </span>
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>

    function showOrderStatusModal(order_id,newIndex,newStatus,TitleLabel, BtnLabel, urlAction, type) {
        const modal = document.getElementById("modal_status_component");

        const title = modal.querySelector('#title_modal');
        const label = modal.querySelector('#send_status_btn_label');
        const orderStep = modal.querySelector('#order-step');
        const orderStatus = modal.querySelector('#order-status');

        orderStep.value = newIndex;
        orderStatus.value = newStatus;

        title.innerHTML = TitleLabel ? TitleLabel : "{{ __('messages.mail.modal.header') }}";
        label.innerHTML = BtnLabel ? BtnLabel : "{{ __('messages.mail.modal.send_status') }}";

        // Show the modal
        modal.classList.remove("pointer-events-none", "fade-out");
        modal.classList.add("fade-in");

        const statusButton = modal.querySelector("#status_modal");
        statusButton.addEventListener("click", () => closeOrderStatusModal());


        const form = modal.querySelector('.modal_content');

        form.action = urlAction;

    };



    function closeOrderStatusModal() {
        // Fade out the modal and hide after animation

        const modal = document.getElementById("modal_status_component");

        modal.classList.add("pointer-events-none");
        modal.classList.add("fade-out");
        modal.classList.remove("fade-in");
    };

</script>
@endpush
