<div id="question_{{$id}}" class="w-full h-auto flex flex-col py-2 border-b border-slate-200/80">
    <div id="questionHeader_{{$id}}" class="w-full h-auto flex flex-row justify-between items-center py-4 cursor-pointer select-none group">
        <h3 class="text-slate-900 group-hover:text-primary font-bold text-base sm:text-lg max-w-[88%] transition-colors duration-150">{{ $question }}</h3>
        <div id="toggleButton_{{$id}}" class="h-9 w-9 rounded-lg flex items-center justify-center bg-slate-100 group-hover:bg-primary group-hover:text-white text-slate-700 duration-150 shrink-0">
            <div id="iconOpen_{{$id}}" class="w-full h-full flex justify-center items-center">
                <x-heroicon-o-plus class="h-4 w-4" />
            </div>
            <div id="iconClose_{{$id}}" class="hidden w-full h-full flex justify-center items-center">
                <x-heroicon-o-minus class="h-4 w-4" />
            </div>
        </div>
    </div>
    <div id="answerContainer_{{$id}}" class="w-full max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
        <div class="pb-5 text-slate-600 text-base leading-relaxed max-w-4xl">
            {!! $answer !!}
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const questionHeader = document.getElementById("questionHeader_{{$id}}");
        const answerContainer = document.getElementById("answerContainer_{{$id}}");
        const iconOpen = document.getElementById("iconOpen_{{$id}}");
        const iconClose = document.getElementById("iconClose_{{$id}}");

        if (questionHeader && answerContainer) {
            questionHeader.addEventListener("click", function() {
                const isOpen = answerContainer.classList.contains("max-h-96");

                if (isOpen) {
                    answerContainer.classList.remove("max-h-96");
                    answerContainer.classList.add("max-h-0");
                    iconOpen.classList.remove("hidden");
                    iconClose.classList.add("hidden");
                } else {
                    answerContainer.classList.remove("max-h-0");
                    answerContainer.classList.add("max-h-96");
                    iconOpen.classList.add("hidden");
                    iconClose.classList.remove("hidden");
                }
            });
        }
    });
</script>
