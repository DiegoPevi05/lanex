@php
    // Find the label of the current option based on the selected value
    $currentOptionLabel = '';
    foreach ($options as $option) {
        if ($option['value'] == $currentDropDownOption) {
            $currentOptionLabel = __($option['label']);
            break;
        }
    }
@endphp

<div class="relative w-full h-full  border-2 border-gray-light rounded-xl">
    <div
        data-id="{{$id}}"
        class="drop-down-selector w-auto h-auto flex flex-row items-center gap-x-1 rounded-xl py-2 px-3 bg-white border-2 border-white font-bold text-primary cursor-pointer duration-300 hover:text-white hover:bg-secondary-dark hover:border-secondary-dark">
        <!-- Display the currently selected language -->
        <span data-id="{{$currentDropDownOption}}" class="current_option capitalize text-sm">
            {{ $currentOptionLabel ? $currentOptionLabel : __('messages.dashboard.web.dropdown_search') }}
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="m6 9 6 6 6-6"/></svg>
    </div>

    <!-- Dropdown options, hidden by default -->
    <div id="dropdown-options-{{$id}}" class="dropdown-options absolute right-0 w-full mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-[120] hidden">
        <div class="p-none">
            @foreach ($options as $option)
                <div
                    data-label="{{ __($option['label']) }}"
                    data-value="{{ $option['value'] }}"
                    onclick="setCurrentOption('{{ __($option['label']) }}', '{{ $option['value'] }}')"
                    class="capitalize px-4 py-2 text-primary font-bold hover:bg-secondary-dark hover:text-white cursor-pointer text-sm duration-300
                        @if($loop->first) rounded-t-md @endif
                        @if($loop->last) rounded-b-md @endif">
                        {{ __($option['label']) }}
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    // Function to toggle dropdowns based on clicked component
    function attachDropdownEvent(id) {
        const selector = document.querySelector(`.drop-down-selector[data-id='${id}']`);
        if (selector) {
            selector.addEventListener('click', function () {
                const dropdown = document.querySelector(`#dropdown-options-${id}`);
                if (dropdown) {
                    dropdown.classList.toggle('hidden');
                }
            });
        }
    }

    // Set selected option and update the dropdown
    function setCurrentOption(label, value) {
        // Find the correct dropdown selector based on its data-id
        const dropDownSelector = document.querySelector(`.drop-down-selector[data-id='{{$id}}']`);

        // Find the current_option span within the specific dropdown
        const currentOption = dropDownSelector.querySelector('.current_option');

        // Update the text and data-id of the selected option
        currentOption.textContent = label;
        currentOption.setAttribute('data-id', value);

        // Dispatch a custom event to notify that the option has been set
        const event = new CustomEvent(`dropdown-{{$id}}`, {  // Corrected the quote here
            detail: { label: label, value: value }
        });
        dropDownSelector.dispatchEvent(event);
    }

    attachDropdownEvent('{{$id}}');

</script>
