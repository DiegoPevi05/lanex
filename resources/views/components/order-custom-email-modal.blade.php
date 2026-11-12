<div id="modal_custom_email_component" class="modal_component hidden pointer-events-none fixed inset-0 z-[1500] items-center justify-center bg-slate-950/60 backdrop-blur-sm p-4">
    <form class="modal_content bg-white w-full max-w-lg rounded-2xl border border-slate-200 shadow-2xl relative flex flex-col items-center justify-center p-6 sm:p-8 gap-y-4 max-h-[90vh] overflow-y-auto" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <button type="button" id="status_modal" onclick="closeOrderCustomEmailModal()" class="absolute top-4 right-4 h-8 w-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors cursor-pointer">
            ✕
        </button>

        <span class="text-primary h-14 w-14 rounded-2xl bg-purple-50 border border-purple-200/70 flex items-center justify-center p-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        </span>

        <label id="title_modal" class="title_modal font-bold text-lg text-slate-900 text-center font-display">
            {{ __('messages.mail.modal.custom_email_header') }}
        </label>
        <p id="content_modal" class="content_modal text-slate-600 text-xs text-center -mt-2">
            {{ __('messages.mail.modal.custom_email_subheader') }}
        </p>

        <div class="w-full flex flex-col gap-1">
            <label for="email_subject" class="block text-xs font-bold uppercase tracking-wider text-slate-700">{{ __('messages.mail.modal.custom_email_subject') }}</label>
            <input type="text" id="email_subject" name="email_subject" class="text-xs h-10 px-3.5 block w-full rounded-xl border border-slate-300 bg-slate-50/60 focus:bg-white focus:border-primary focus:outline-none text-slate-900" placeholder="{{ __('messages.mail.modal.custom_email_subject_placeholder') }}">
        </div>

        <div class="w-full flex flex-col gap-1">
            <label for="email_title" class="block text-xs font-bold uppercase tracking-wider text-slate-700">{{ __('messages.mail.modal.custom_email_title') }}</label>
            <input type="text" id="email_title" name="email_title" class="text-xs h-10 px-3.5 block w-full rounded-xl border border-slate-300 bg-slate-50/60 focus:bg-white focus:border-primary focus:outline-none text-slate-900" placeholder="{{ __('messages.mail.modal.custom_email_title_placeholder') }}">
        </div>

        <div class="w-full flex flex-col gap-1">
            <label for="email_content" class="block text-xs font-bold uppercase tracking-wider text-slate-700">{{ __('messages.mail.modal.custom_email_content') }}</label>
            <textarea id="email_content" name="email_content" rows="3" class="text-xs p-3.5 block w-full rounded-xl border border-slate-300 bg-slate-50/60 focus:bg-white focus:border-primary focus:outline-none text-slate-900" placeholder="{{ __('messages.mail.modal.custom_email_content_placeholder') }}"></textarea>
        </div>

        <div class="w-full flex flex-row justify-between items-center px-4 py-3 rounded-xl bg-slate-50 border border-slate-200/80">
            <p class="text-xs text-slate-700 font-semibold">{{ __('messages.mail.modal.custom_email_details') }}</p>
            <div class="checkbox-wrapper-2">
                <input type="checkbox" class="sc-gJwTLC ikxBAC" id="email_order_details" name="email_order_details">
            </div>
        </div>

        <label id="file_title_modal" class="font-semibold text-xs text-primary text-center">{{ __('messages.mail.modal.pdf_message') }}</label>
        <input id="pdf-archive" name="pdf-archive" type="file" class="upload-file-input"/>

        <div class="w-full flex items-center justify-end gap-2.5 pt-2">
            <button id="cancel_status_btn" onclick="closeOrderCustomEmailModal()" type="button" class="h-10 px-4 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold capitalize transition-colors">
                {{__('messages.common.cancel')}}
            </button>
            <button id="send_status_btn" type="submit" class="h-10 px-5 bg-primary hover:bg-primary-dark text-white rounded-xl text-xs font-semibold capitalize transition-colors inline-flex items-center gap-x-2">
                <span id="send_status_btn_label">{{ __('messages.mail.modal.custom_email_btn_msg') }}</span>
                <span id="loader_status_spinner" class="w-4 h-4 hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="animate-spin"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                </span>
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function showOrderCustomEmailModal(order_id, urlAction) {
        const modal = document.getElementById("modal_custom_email_component");
        if (!modal) return;

        const form = modal.querySelector('.modal_content');
        form.action = urlAction;

        modal.classList.remove("hidden", "pointer-events-none", "fade-out");
        modal.classList.add("flex", "fade-in");
    }

    function closeOrderCustomEmailModal() {
        const modal = document.getElementById("modal_custom_email_component");
        if (!modal) return;

        modal.classList.add("hidden", "pointer-events-none", "fade-out");
        modal.classList.remove("flex", "fade-in");
    }
</script>
@endpush
