<div id="{{$id}}" class="w-full h-auto flex flex-col sm:flex-row gap-2">
    <div class="w-full flex flex-col sm:flex-row gap-2">
        <div class="w-full sm:flex-1">
            <input name="search-input-value" class="w-full h-10 px-3.5 text-xs rounded-xl border border-slate-300 bg-slate-50/60 focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/15 focus:outline-none placeholder:text-slate-400 font-medium text-slate-800 transition-all" placeholder="{{__($placeholderInput)}}" />
        </div>
        <div class="w-full sm:w-44 shrink-0">
            <x-drop-down
                :id="$dropDownId"
                :currentDropDownOption="$currentDropDownOption"
                :options="$dropDownOptions"
            />
        </div>
    </div>
    <div class="w-full sm:w-auto shrink-0">
        <button class="on-trigger-search h-10 px-4 w-full rounded-xl bg-slate-900 hover:bg-primary text-white duration-200 transition-colors font-semibold text-xs flex items-center justify-center gap-x-2 capitalize">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            <span>{{__($labelButton)}}</span>
        </button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchBar = document.querySelector('#{{$id}}');

        function triggerSearch() {
            const dropDownSelector = document.querySelector(`.drop-down-selector[data-id='{{$dropDownId}}']`);
            const currentOptionFilter = dropDownSelector.querySelector('.current_option');
            const searchBarInput = searchBar.querySelector("input[name='search-input-value']");

            const event = new CustomEvent(`search-{{$id}}`, {
                detail: {
                    key: currentOptionFilter.dataset.id,
                    value: searchBarInput.value
                }
            });

            searchBar.dispatchEvent(event);
        }

        const searchInput = searchBar.querySelector(".on-trigger-search");
        if (searchInput) {
            searchInput.addEventListener('click', triggerSearch);
        }
    });
</script>
