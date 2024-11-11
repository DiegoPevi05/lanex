<div id="{{$id}}" class="w-full h-auto flex flex-col sm:flex-row gap-y-2 sm:gap-x-4">
    <div class="w-full p-none m-none flex flex-row gap-x-2">
        <div class="w-full">
            <input name="search-input-value" class="capitalize w-full h-full border-gray-light border-2 focus:outline-none p-2 rounded-xl placeholder:text-gray-300 font-bold text-body" placeholder="{{__($placeholderInput)}}" />
        </div>
        <div class="w-full">
            <x-drop-down
                :id="$dropDownId"
                :currentDropDownOption="$currentDropDownOption"
                :options="$dropDownOptions"
            />
        </div>
    </div>
    <div class="w-full sm:w-auto">
        <button  class="on-trigger-search py-2 sm:px-4 w-full h-full rounded-xl bg-primary hover:bg-primary-dark text-white duration-300 transition-all font-bold flex items-center justify-center gap-x-2 capitalize">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            {{__($labelButton)}}
        </button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const searchBar = document.querySelector('#{{$id}}');

        function triggerSearch() {
            const dropDownSelector = document.querySelector(`.drop-down-selector[data-id='{{$dropDownId}}']`);

            // Find the current_option span within the specific dropdown
            const currentOptionFilter = dropDownSelector.querySelector('.current_option');
            const searchBarInput = searchBar.querySelector("input[name='search-input-value']"); // Corrected selector to properly select input

            // Dispatch a custom event to notify that the option has been set
            const event = new CustomEvent(`search-{{$id}}`, {
                detail: {
                    key: currentOptionFilter.dataset.id, // Corrected to use dataset for accessing data attributes
                    value: searchBarInput.value // Fixed syntax by removing the semicolon
                }
            });

            searchBar.dispatchEvent(event);

        };

        const searchInput = searchBar.querySelector(".on-trigger-search");
        searchInput.addEventListener('click', triggerSearch);

    });
</script>
