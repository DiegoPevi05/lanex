<div class="relative inline-block text-left z-[60]">
    <div
        data-id="{{$id}}"
        class="language-selector w-auto h-auto flex flex-row items-center gap-x-1 rounded-xl py-2 px-3 bg-primary border-2 border-primary font-bold text-white cursor-pointer duration-300 hover:text-white hover:bg-primary-dark">
        <!-- Display the currently selected language -->
        <span id="selected-lang">{{ app()->getLocale() === 'en' ? 'EN' : 'ES' }}</span>
        <x-heroicon-o-chevron-down class="h-5 w-5 text-white group-hover:text-white"/>
    </div>

    <!-- Dropdown options, hidden by default -->
    <div id="dropdown-options-{{$id}}" class="dropdown-options absolute right-0 w-full mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-[120] hidden">
        <div class="p-none">
            <!-- English Option -->
            <div onclick="setLanguage('{{ route('set-language', ['lang' => 'en']) }}')" class="px-4 py-2 text-primary font-bold hover:bg-primary hover:text-white cursor-pointer rounded-t-md duration-300">EN</div>
            <!-- Spanish Option -->
            <div onclick="setLanguage('{{ route('set-language', ['lang' => 'es']) }}')" class="px-4 py-2 text-primary font-bold hover:bg-primary hover:text-white cursor-pointer rounded-b-md duration-300">ES</div>
        </div>
    </div>
</div>

<script>
// Function to toggle dropdowns based on clicked component
    document.querySelectorAll('.language-selector').forEach(selector => {
        selector.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const dropdown = document.querySelector(`#dropdown-options-${id}`);
            dropdown.classList.toggle('hidden');
        });
    });

    // Set language and navigate to the route
    function setLanguage(url) {
        window.location.href = url;
    }
</script>
