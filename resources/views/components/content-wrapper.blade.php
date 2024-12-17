<div id="order_detail_{{$id}}" class="w-full h-auto px-4 py-2 ">
    <div class="w-full flex flex-row justify-between items-center max-sm:pb-2">
        <label class="font-bold text-primary w-auto">{{ __('messages.track.order.order_details') }}</label>
        <button id="toggleButton_{{$id}}" class="bg-primary-dark hover:bg-secondary-dark text-white rounded-xl p-2 px-4 duration-300 active:scale-95 transition-all inline-flex gap-x-2 items-center">Ver Detalles
            <svg id="iconOpen_{{$id}}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg>
            <svg id="iconClose_{{$id}}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden"><path d="m18 15-6-6-6 6"/></svg>
        </button>
    </div>
    <div id="detail_contaniner_{{$id}}" class="w-full h-auto overflow-y-scroll !h-[0px] transition-all duration-300">
        <div id="detail_content_{{$id}}" class="w-full h-full transition-all duration-300 opacity-0">
            {{ $slot }}
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleButton = document.getElementById("toggleButton_{{$id}}");
        const detailContainer = document.getElementById("detail_contaniner_{{$id}}");
        const detailContent = document.getElementById("detail_content_{{$id}}");
        const iconOpen = document.getElementById("iconOpen_{{$id}}");
        const iconClose = document.getElementById("iconClose_{{$id}}");

        toggleButton.addEventListener("click", function() {
            // Toggle the height and opacity classes
            detailContainer.classList.toggle("!h-[0px]");
            detailContainer.classList.toggle("h-[400px]");
            detailContainer.classList.toggle("sm:h-[400px]");

            // Toggle opacity for the answer text
            detailContent.classList.toggle("opacity-0");
            detailContent.classList.toggle("opacity-100");

            // Toggle the icon
            iconOpen.classList.toggle("hidden");
            iconClose.classList.toggle("hidden");
        });
    });

</script>
