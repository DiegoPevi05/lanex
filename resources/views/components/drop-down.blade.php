@php
    $currentOptionLabel = '';
    foreach ($options as $option) {
        if ($option['value'] == $currentDropDownOption) {
            $currentOptionLabel = __($option['label']);
            break;
        }
    }
@endphp

<div class="relative w-full h-10">
    <div
        data-id="{{$id}}"
        class="drop-down-selector w-full h-10 flex flex-row items-center justify-between gap-x-2 rounded-xl px-3.5 bg-slate-50/70 border border-slate-300 font-semibold text-slate-700 cursor-pointer duration-200 hover:border-primary hover:text-primary">
        <span data-id="{{$currentDropDownOption}}" class="current_option capitalize text-xs truncate">
            {{ $currentOptionLabel ? $currentOptionLabel : __('messages.dashboard.web.dropdown_search') }}
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
    </div>

    <!-- Dropdown options, hidden by default -->
    <div id="dropdown-options-{{$id}}" class="dropdown-options absolute right-0 w-full mt-1.5 rounded-xl shadow-lg bg-white border border-slate-200 focus:outline-none z-[120] hidden overflow-hidden">
        <div class="py-1">
            @foreach ($options as $option)
                <div
                    data-label="{{ __($option['label']) }}"
                    data-value="{{ $option['value'] }}"
                    onclick="setCurrentOption('{{ __($option['label']) }}', '{{ $option['value'] }}')"
                    class="capitalize px-3.5 py-2 text-slate-700 font-semibold hover:bg-purple-50 hover:text-primary cursor-pointer text-xs duration-150">
                        {{ __($option['label']) }}
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
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

    function setCurrentOption(label, value) {
        const dropDownSelector = document.querySelector(`.drop-down-selector[data-id='{{$id}}']`);
        const currentOption = dropDownSelector.querySelector('.current_option');

        currentOption.textContent = label;
        currentOption.setAttribute('data-id', value);

        const dropdown = document.querySelector('#dropdown-options-{{$id}}');
        if (dropdown) {
            dropdown.classList.toggle('hidden');
        }
    }

    attachDropdownEvent('{{$id}}');
</script>
