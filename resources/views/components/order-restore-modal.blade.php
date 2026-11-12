<div id="modal_restore_component" class="modal_component hidden pointer-events-none fixed inset-0 z-[1500] items-center justify-center bg-slate-950/60 backdrop-blur-sm p-4">
    <form class="modal_content bg-white w-full max-w-md rounded-2xl border border-slate-200 shadow-2xl relative flex flex-col items-center justify-center p-6 sm:p-8 gap-y-4" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <button type="button" id="status_modal" onclick="closeOrderRestoreModal()" class="absolute top-4 right-4 h-8 w-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors cursor-pointer">
            ✕
        </button>

        <span class="text-primary h-14 w-14 rounded-2xl bg-purple-50 border border-purple-200/70 flex items-center justify-center p-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><rect width="20" height="5" x="2" y="3" rx="1"/><path d="M4 8v11a2 2 0 0 0 2 2h2"/><path d="M20 8v11a2 2 0 0 1-2 2h-2"/><path d="m9 15 3-3 3 3"/><path d="M12 12v9"/></svg>
        </span>

        <label id="title_modal" class="title_modal font-bold text-lg text-slate-900 text-center font-display">
            {{ __('messages.dashboard.history.modal.header') }}
        </label>
        <p id="content_modal" class="content_modal text-slate-600 text-sm text-center">
            {{ __('messages.dashboard.history.modal.subheader') }}
        </p>

        <div class="w-full flex items-center justify-end gap-2.5 pt-2">
            <button id="cancel_status_btn" onclick="closeOrderRestoreModal()" type="button" class="h-10 px-4 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold capitalize transition-colors">
                {{__('messages.common.cancel')}}
            </button>
            <button id="send_status_btn" type="submit" class="h-10 px-5 bg-primary hover:bg-primary-dark text-white rounded-xl text-xs font-semibold capitalize transition-colors inline-flex items-center gap-x-2">
                <span id="send_status_btn_label">{{ __('messages.dashboard.history.modal.btn_label') }}</span>
                <span id="loader_status_spinner" class="w-4 h-4 hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="animate-spin"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                </span>
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function showRestoreOrderModal(order_id, urlAction) {
        const modal = document.getElementById("modal_restore_component");
        if (!modal) return;

        const form = modal.querySelector('.modal_content');
        form.action = urlAction;

        modal.classList.remove("hidden", "pointer-events-none", "fade-out");
        modal.classList.add("flex", "fade-in");
    }

    function closeOrderRestoreModal() {
        const modal = document.getElementById("modal_restore_component");
        if (!modal) return;

        modal.classList.add("hidden", "pointer-events-none", "fade-out");
        modal.classList.remove("flex", "fade-in");
    }
</script>
@endpush
