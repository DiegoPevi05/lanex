<div id="toasts_container" class="fixed right-0 w-[400px] h-screen flex flex-col justify-end items-end bg-transparent z-[1000] p-4 gap-y-4 transition-all pointer-events-none">
    <div class="toast_template pointer-events-none w-full flex flex-col h-auto bg-white shadow-xl p-4 rounded-xl animation-element gap-y-2 border-2 transition-all">
        <span class="delete_toast_button  absolute top-2 right-2 h-5 w-5 flex items-center text-body justify-center duration-300 hover:text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </span>
        <div class="w-full inline-flex justify-start items-center">
            <p class="toast_hour text-primary text-sm">14:05</p>
        </div>
        <p class="toast_message text-body text-sm w-full">Message that someone have writteng completelle</p>
    </div>
</div>
@push('scripts')
    <script>
        function showToast(messages) {
            const toastContainer = document.getElementById("toasts_container");
            messages.forEach((message)=>{
                const toastTemplate = toastContainer.querySelector(".toast_template");

                // Clone the toast template node
                const newToast = toastTemplate.cloneNode(true);
                newToast.classList.remove("pointer-events-none");
                newToast.classList.add("slide-in-down","pointer-events-auto"); // Add the animation class for sliding in

                // Set the message in the cloned toast
                newToast.querySelector(".toast_message").textContent = message;

                // Set the current hour in hh:mm format
                const currentHour = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                newToast.querySelector(".toast_hour").textContent = currentHour;

                // Remove on click of the delete button
                const deleteButton = newToast.querySelector(".delete_toast_button");
                deleteButton.addEventListener("click", () => {
                    removeToast(newToast);
                });

                function removeToast(toast) {
                    toast.classList.add("slide-out-down");
                    toast.classList.remove("slide-in-down");

                    // Remove the toast from DOM after animation
                    setTimeout(() => {
                        toastContainer.removeChild(toast);
                    }, 800); // match with animation duration
                }

                // Append the new toast to the container
                toastContainer.appendChild(newToast);
            })
        }
    </script>
@endpush
