<section id="questions" class="w-full h-auto xl:min-h-screen bg-white text-body animation-group">
    <div class="relative w-full h-full padding flex flex-col justify-start items-start">
        <h1 class="font-bold text-primary animation-element slide-in-up">
            {{$title}}
        </h1>
        <div class="w-full h-full flex flex-col  justify-start items-end mt-12 sm:mt-24 animation-element slide-in-left">
            @foreach ($questions as $question)
                <livewire:faq-question
                    :id="$question['id']"
                    :question="$question['question']"
                    :answer="$question['answer']"
                />
            @endforeach
        </div>
    </div>
</section>
