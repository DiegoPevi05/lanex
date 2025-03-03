<div id="question_{{$id}}" class="w-full xl:w-[80%] h-auto flex flex-col py-4 sm:p-4">
    <div class="w-full h-auto flex flex-row justify-between items-center py-4">
        <h3 class="text-secondary-dark max-w-[80%]">{{ $question }}</h3>
        <div id="toggleButton_{{$id}}" class="h-8 sm:h-12 w-8 sm:w-12 rounded-full flex items-center justify-center bg-gray-light sm:p-3 hover:bg-secondary-dark hover:cursor-pointer duration-300 active:scale-95 group">
            <div id="iconOpen_{{$id}}" class="w-full h-full flex justify-center items-center">
                <x-heroicon-o-plus class="h-5 sm:h-full w-5 sm:w-full group-hover:text-white" />
            </div>
            <div id="iconClose_{{$id}}" class="hidden w-full h-full flex justify-center items-center">
                <x-heroicon-o-minus class="h-5 sm:h-full w-5 sm:w-full group-hover:text-white" />
            </div>
        </div>
    </div>
    <div id="answerContainer_{{$id}}" class="w-full px-none sm:px-6 xl:px-12 border-b-2 border-gray-light pb-2 sm:py-4 transition-all duration-300 overflow-y-scroll h-[0px] no-scroll-bar">
        <p id="answer_{{$id}}" class="w-full h-full transition-all duration-300 opacity-0 text-lg/6">
            {!! $answer !!}
        </p>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleButton = document.getElementById("toggleButton_{{$id}}");
        const answerContainer = document.getElementById("answerContainer_{{$id}}");
        const answerText = document.getElementById("answer_{{$id}}");
        const iconOpen = document.getElementById("iconOpen_{{$id}}");
        const iconClose = document.getElementById("iconClose_{{$id}}");

        toggleButton.addEventListener("click", function() {
            // Toggle the height and opacity classes
            answerContainer.classList.toggle("h-[0px]");
            answerContainer.classList.toggle("h-[150px]");
            answerContainer.classList.toggle("sm:h-[200px]");

            // Toggle opacity for the answer text
            answerText.classList.toggle("opacity-0");
            answerText.classList.toggle("opacity-100");

            // Toggle the icon
            iconOpen.classList.toggle("hidden");
            iconClose.classList.toggle("hidden");
        });
    });

</script>
