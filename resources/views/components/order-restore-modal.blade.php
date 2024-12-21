<div id="modal_restore_component" class="modal_component animation-element no-delay pointer-events-none fixed h-screen w-screen top-0 bottom-0 left-0 right-0 z-[1500] flex items-center justify-center" style="background-color:rgba(0, 0, 0, 0.5);">
    <form class="modal_content bg-white h-auto max-sm:mx-4 sm:min-h-[200px] sm:min-w-[400px] p-4 rounded-xl relative flex flex-col items-center justify-center p-4 sm:p-12 gap-y-4" action="#" method="POST"  enctype="multipart/form-data">

        @csrf <!-- Include CSRF token for security -->
        @method('POST') <!-- Specify DELETE method for deleting -->
        <span id="status_modal" class="absolute top-2 right-2 cursor-pointer text-gray-500 hover:text-red-500">✖</span>

        <span class="text-primary h-20 w-20">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-full w-full lucide lucide-archive-restore"><rect width="20" height="5" x="2" y="3" rx="1"/><path d="M4 8v11a2 2 0 0 0 2 2h2"/><path d="M20 8v11a2 2 0 0 1-2 2h-2"/><path d="m9 15 3-3 3 3"/><path d="M12 12v9"/></svg>
        </span>

        <label id="title_modal" class="title_modal font-bold text-xl text-primary mb-4 text-center">
            {{ __('messages.dashboard.history.modal.header') }}
        </label>
        <p id="content_modal" class="content_modal text-gray-700 text-md text-center">
            {{ __('messages.dashboard.history.modal.subheader') }}
        </p>
        <div class="h-auto w-auto gap-x-4 flex justify-between">
            <button id="cancel_status_btn" onclick="closeOrderRestoreModal()" type="button"  class="w-auto h-full py-2 px-6 bg-primary capitalize text-white rounded-xl active:scale-95 hover:bg-secondary-dark duration-300 font-bold inline-flex items-center gap-x-2 text-lg">
                {{__('messages.common.cancel')}}
            </button>
            <button id="send_status_btn" type="submit" class="w-auto h-full py-2 px-6 bg-primary capitalize text-white rounded-xl active:scale-95 hover:bg-secondary-dark duration-300 font-bold inline-flex items-center gap-x-2 text-lg">
                <p id="send_status_btn_label" class="h-full text-lg">{{ __('messages.dashboard.history.modal.btn_label') }}</p>
                <span id="loader_status_spinner" class="w-6 h-6 hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="animate-spin lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                </span>
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function showRestoreOrderModal(order_id, urlAction) {
        const modal = document.getElementById("modal_restore_component");

        // Show the modal
        modal.classList.remove("pointer-events-none", "fade-out");
        modal.classList.add("fade-in");

        const statusButton = modal.querySelector("#status_modal");
        statusButton.addEventListener("click", () => closeOrderRestoreModal());


        const form = modal.querySelector('.modal_content');

        form.action = urlAction;

    };



    function closeOrderRestoreModal() {
        // Fade out the modal and hide after animation

        const modal = document.getElementById("modal_restore_component");

        modal.classList.add("pointer-events-none");
        modal.classList.add("fade-out");
        modal.classList.remove("fade-in");
    };

</script>
@endpush
