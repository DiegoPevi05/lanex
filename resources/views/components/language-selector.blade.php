<div class="relative inline-block text-left z-[120]">
    <div
        data-id="{{$id}}"
        class="language-selector w-auto h-7 inline-flex flex-row items-center gap-x-1 rounded-lg px-2 py-0.5 bg-slate-800/90 hover:bg-primary border border-slate-700 hover:border-primary text-[11px] font-semibold tracking-wider text-slate-200 hover:text-white cursor-pointer transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-purple-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
        <span id="selected-lang" class="leading-none">{{ app()->getLocale() === 'en' ? 'EN' : 'ES' }}</span>
        <span class="h-3 w-3 text-slate-400 shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
        </span>
    </div>

    <!-- Dropdown options, hidden by default -->
    <div id="dropdown-options-{{$id}}" class="dropdown-options absolute right-0 min-w-[64px] mt-1.5 rounded-lg shadow-lg bg-slate-900 border border-slate-700 focus:outline-none z-[120] hidden overflow-hidden">
        <div class="p-0.5 flex flex-col gap-0.5">
            <!-- Spanish Option -->
            <div onclick="setLanguage('{{ route('set-language', ['lang' => 'es']) }}')" class="px-2.5 py-1 text-[11px] font-semibold {{ app()->getLocale() !== 'en' ? 'bg-primary text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white' }} cursor-pointer rounded-md transition-colors text-center">ES</div>
            <!-- English Option -->
            <div onclick="setLanguage('{{ route('set-language', ['lang' => 'en']) }}')" class="px-2.5 py-1 text-[11px] font-semibold {{ app()->getLocale() === 'en' ? 'bg-primary text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white' }} cursor-pointer rounded-md transition-colors text-center">EN</div>
        </div>
    </div>
</div>

<script>
    // Set language and navigate to the route
    function setLanguage(url) {
        window.location.href = url;
    }
</script>
