<div id="modal_delete_component_{{$id}}" data-default-action="{{ !empty($deleteRoute) ? route($deleteRoute, $id) : '#' }}" class="modal_component modal_delete_instance hidden pointer-events-none fixed inset-0 z-[1500] items-center justify-center bg-slate-950/60 backdrop-blur-sm p-4">
    <form id="delete-modal-form" action="{{ !empty($deleteRoute) ? route($deleteRoute, $id) : '#' }}" class="modal_content bg-white w-full max-w-md rounded-2xl border border-slate-200 shadow-2xl relative flex flex-col items-center justify-center p-6 sm:p-8 gap-y-4" method="POST">
        @csrf
        @method('DELETE')
        <button type="button" id="delete_modal" onclick="closeDeleteModal()" class="absolute top-4 right-4 h-8 w-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors cursor-pointer">
            ✕
        </button>

        <span class="text-red-600 h-14 w-14 rounded-2xl bg-red-50 border border-red-200/70 flex items-center justify-center p-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/><path d="M12 9v4"/><path d="M12 17h.01"/>
            </svg>
        </span>

        <label id="title_modal" class="title_modal font-bold text-lg text-slate-900 text-center font-display"></label>
        <p id="content_modal" class="content_modal text-slate-600 text-sm text-center"></p>

        <div id="email_notification_section" class="hidden w-full flex flex-row justify-between items-center px-4 py-3 rounded-xl bg-slate-50 border border-slate-200/80">
            <p class="text-xs text-slate-700 font-semibold">{{ __('messages.mail.modal.email_notification') }}</p>
            <div class="checkbox-wrapper-2">
                <input type="checkbox" class="sc-gJwTLC ikxBAC" id="email-notification" name="email-notification">
            </div>
        </div>

        <div class="w-full flex items-center justify-end gap-2.5 pt-2">
            <button onclick="closeDeleteModal()" type="button" class="h-10 px-4 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold capitalize transition-colors">
                {{__('messages.common.cancel')}}
            </button>
            <button id="send_delete_btn_label" type="submit" class="h-10 px-5 bg-red-600 hover:bg-red-700 text-white rounded-xl text-xs font-semibold capitalize transition-colors">
                {{__('messages.common.delete')}}
            </button>
        </div>
    </form>
</div>

@once
@push('scripts')
<script>
    function showDeleteModal(title, content, urlAction, BtnLabel, type) {
        const modal = document.querySelector(".modal_delete_instance");
        if (!modal) return;

        const titleElement = modal.querySelector("#title_modal");
        const contentElement = modal.querySelector("#content_modal");
        const form = modal.querySelector('#delete-modal-form');
        const emailNotificationSection = modal.querySelector('#email_notification_section');
        const BtnInput = modal.querySelector('#send_delete_btn_label');

        if (type === "cancel") {
            emailNotificationSection.classList.remove('hidden');
        } else {
            emailNotificationSection.classList.add('hidden');
        }

        BtnInput.innerHTML = BtnLabel ? BtnLabel : "{{__('messages.common.delete')}}";
        form.action = urlAction ? urlAction : (modal.getAttribute('data-default-action') || '#');

        titleElement.textContent = title;
        contentElement.textContent = content;

        modal.classList.remove("hidden", "pointer-events-none", "fade-out");
        modal.classList.add("flex", "fade-in");
    }

    function closeDeleteModal() {
        document.querySelectorAll(".modal_delete_instance").forEach((modal) => {
            modal.classList.add("hidden", "pointer-events-none", "fade-out");
            modal.classList.remove("flex", "fade-in");
        });
    }
</script>
@endpush
@endonce
