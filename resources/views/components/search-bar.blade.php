<div id="{{$id}}" class="w-full h-auto flex flex-row gap-x-2">
    <div class="w-3/5">
        <input class="w-full h-full border-gray-light border-2 focus:outline-none p-2 rounded-xl placeholder:text-gray-300 font-bold text-body" placeholder="{{__($placeholderInput)}}" />
    </div>
    <div class="w-1/5">
        <x-drop-down
            :id="$dropDownId"
            :currentDropDownOption="$currentDropDownOption"
            :options="$dropDownOptions"
        />
    </div>
    <div class="w-1/5">
        <button class="w-full h-full rounded-xl bg-primary hover:bg-primary-dark text-white duration-300 transition-all font-bold flex items-center justify-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            {{__($labelButton)}}
        </button>
    </div>
</div>

