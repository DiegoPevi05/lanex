<div id="modal_delete_component" class="modal_component animation-element no-delay pointer-events-none fixed h-screen w-screen top-0 bottom-0 left-0 right-0 z-[1500] flex items-center justify-center" style="background-color:rgba(0, 0, 0, 0.5);">
    <div class="modal_content bg-white h-auto sm:h-screen  max-h-[400px] sm:min-h-[200px] sm:min-w-[400px] p-4 rounded-xl relative flex flex-col items-center justify-center p-4 gap-y-4">
        <span id="delete_modal" class="absolute top-2 right-2 cursor-pointer text-gray-500 hover:text-red-500">✖</span>

        <span class="text-primary h-20 w-20">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/><path d="M12 9v4"/><path d="M12 17h.01"/>
            </svg>
        </span>

        <label id="title_modal" class="title_modal font-bold text-xl text-primary mb-4 text-center"></label>
        <p id="content_modal" class="content_modal text-gray-700 text-md text-center"></p>
        <div class="h-auto w-auto gap-x-4 flex justify-between">
            <button onclick="closeDeleteModal()"  class="w-auto h-full py-2 px-6 bg-primary capitalize text-white rounded-xl active:scale-95 hover:bg-secondary-dark duration-300 font-bold inline-flex items-center gap-x-2 text-lg">
                {{__('messages.common.cancel')}}
            </button>
            <form id="delete-form" action="{{ route($deleteRoute, $id) }}" method="POST">
                @csrf <!-- Include CSRF token for security -->
                @method('DELETE') <!-- Specify DELETE method for deleting -->
                <button class="w-auto h-full py-2 px-6 bg-primary capitalize text-white rounded-xl active:scale-95 hover:bg-secondary-dark duration-300 font-bold inline-flex items-center gap-x-2 text-lg">
                    {{__('messages.common.delete')}}
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function showDeleteModal(title, content) {
        const modal = document.getElementById("modal_delete_component");
        const titleElement = modal.querySelector("#title_modal");
        const contentElement = modal.querySelector("#content_modal");

        // Set the modal title and content
        titleElement.textContent = title;
        contentElement.textContent = content;

        // Show the modal
        modal.classList.remove("pointer-events-none", "fade-out");
        modal.classList.add("fade-in");

        const deleteButton = modal.querySelector("#delete_modal");
        deleteButton.addEventListener("click", () => closeModal());
    };



    function closeDeleteModal() {
        // Fade out the modal and hide after animation

        const modal = document.getElementById("modal_delete_component");

        modal.classList.add("pointer-events-none");
        modal.classList.add("fade-out");
        modal.classList.remove("fade-in");
    };

</script>
@endpush
