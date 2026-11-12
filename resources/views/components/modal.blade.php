<div id="modal_component" class="modal_component hidden pointer-events-none fixed inset-0 z-[1500] items-center justify-center bg-slate-950/60 backdrop-blur-sm p-4">
    <div class="modal_content bg-white w-full max-w-md rounded-2xl border border-slate-200 shadow-2xl relative flex flex-col items-center justify-center p-6 sm:p-8 gap-y-4">
        <button type="button" id="delete_modal" class="absolute top-4 right-4 h-8 w-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors cursor-pointer">
            ✕
        </button>

        <span class="text-primary h-14 w-14 rounded-2xl bg-purple-50 border border-purple-200/70 flex items-center justify-center p-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/><path d="M12 9v4"/><path d="M12 17h.01"/>
            </svg>
        </span>

        <label id="title_modal" class="title_modal font-bold text-lg text-slate-900 text-center font-display"></label>
        <p id="content_modal" class="content_modal text-slate-600 text-sm text-center"></p>
    </div>
</div>

@push('scripts')
<script>
    function showModal(title, content) {
        const modal = document.getElementById("modal_component");
        if (!modal) return;
        const titleElement = modal.querySelector("#title_modal");
        const contentElement = modal.querySelector("#content_modal");

        titleElement.textContent = title;
        contentElement.textContent = content;

        modal.classList.remove("hidden", "pointer-events-none", "fade-out");
        modal.classList.add("flex", "fade-in");

        const deleteButton = modal.querySelector("#delete_modal");
        deleteButton.onclick = () => closeModal(modal);
    }

    function closeModal(modal) {
        if (!modal) return;
        modal.classList.add("hidden", "pointer-events-none", "fade-out");
        modal.classList.remove("flex", "fade-in");
    }
</script>
@endpush
