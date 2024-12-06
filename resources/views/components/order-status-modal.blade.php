<div id="modal_status_component" class="modal_component animation-element no-delay pointer-events-none fixed h-screen w-screen top-0 bottom-0 left-0 right-0 z-[1500] flex items-center justify-center" style="background-color:rgba(0, 0, 0, 0.5);">
    <div class="modal_content bg-white h-auto sm:h-screen  max-h-[400px] sm:min-h-[200px] sm:min-w-[400px] p-4 rounded-xl relative flex flex-col items-center justify-center p-4 sm:p-12 gap-y-4">
        <span id="status_modal" class="absolute top-2 right-2 cursor-pointer text-gray-500 hover:text-red-500">✖</span>

        <span class="text-primary h-20 w-20">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 16h5v5"/></svg>
        </span>

        <label id="title_modal" class="title_modal font-bold text-xl text-primary mb-4 text-center">
            {{ __('messages.mail.modal.header') }}
        </label>
        <p id="content_modal" class="content_modal text-gray-700 text-md text-center">
            {{ __('messages.mail.modal.subheader') }}
        </p>
        <div class="w-full flex flex-row justify-center items-start gap-x-4">
            <p class="text-sm font-bold text-secondary-dark capitalize">{{ __('messages.mail.modal.email_notification') }}</p>
            <input type="checkbox" id="email-notification" name="email-notification" class="text-sm mt-1 block w-auto p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body">
        </div>
        <div class="h-auto w-auto gap-x-4 flex justify-between">
            <button id="cancel_status_btn" onclick="closeOrderStatusModal()"  class="w-auto h-full py-2 px-6 bg-primary capitalize text-white rounded-xl active:scale-95 hover:bg-secondary-dark duration-300 font-bold inline-flex items-center gap-x-2 text-lg">
                {{__('messages.common.cancel')}}
            </button>
            <button id="send_status_btn" class="w-auto h-full py-2 px-6 bg-primary capitalize text-white rounded-xl active:scale-95 hover:bg-secondary-dark duration-300 font-bold inline-flex items-center gap-x-2 text-lg">
                {{ __('messages.mail.modal.send_status') }}
                <span id="loader_status_spinner" class="w-6 h-6 hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="animate-spin lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                </span>
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let updateNewIndexOrder = null;
    let updateNewStatusOrder = null;
    let updateOrderId = null;
    function showOrderStatusModal(order_id,newIndex,newStatus) {
        updateNewIndexOrder = newIndex;
        updateNewStatusOrder = newStatus;
        updateOrderId = order_id;
        const modal = document.getElementById("modal_status_component");

        // Show the modal
        modal.classList.remove("pointer-events-none", "fade-out");
        modal.classList.add("fade-in");

        const statusButton = modal.querySelector("#status_modal");
        statusButton.addEventListener("click", () => closeOrderStatusModal());

        // Add event listener to "send status" button
        const sendButton = modal.querySelector("#send_status_btn");
        sendButton.addEventListener("click", sendOrderStatus);
    };



    function closeOrderStatusModal() {
        // Fade out the modal and hide after animation

        const modal = document.getElementById("modal_status_component");

        modal.classList.add("pointer-events-none");
        modal.classList.add("fade-out");
        modal.classList.remove("fade-in");
    };

    // Function to send the order status update
    async function sendOrderStatus() {

        const modal = document.getElementById("modal_status_component");
        const cancel_button = modal.querySelector("#cancel_status_btn");
        const close_button = modal.querySelector("#status_modal");
        const submit_button = modal.querySelector("#send_status_btn");

        const loader = modal.querySelector("#loader_status_spinner");
        const emailNotification = modal.querySelector("#email-notification").checked;

        cancel_button.style.pointerEvents = 'none';
        close_button.style.pointerEvents = 'none';
        submit_button.style.pointerEvents = 'none';

        loader.classList.remove('hidden');

        const data = {
            step: updateNewIndexOrder,  // Assuming newStatusOrder is the correct step
            status: updateNewStatusOrder,  // Static status for now
            email_notification: emailNotification,
            locale: "{{ app()->getLocale() }}"
        };

        try {
            const response = await fetch(`/dashboard/order/update-status/${updateOrderId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')  // CSRF token for security
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                // Handle successful response
                showToast(result.success);
                location.reload();  // Reload the page after showing the toast
                closeOrderStatusModal();
            } else {
                // Handle error response
                showToast(result.error);
            }
        } catch (error) {
            // Handle unexpected errors
            console.error('Error:', error);
        }finally{
            // Re-enable buttons after the update is finished
            cancel_button.style.pointerEvents = 'auto';
            close_button.style.pointerEvents = 'auto';
            submit_button.style.pointerEvents = 'auto';

            loader.classList.add('hidden');
        }
    }

</script>
@endpush
