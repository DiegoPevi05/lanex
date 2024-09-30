<section id="questions" class="w-full min-h-screen bg-white text-body">
    <div class="relative w-full h-full padding flex flex-col justify-start items-start">
        <h1 class="font-bold text-primary">
            Frequently asked questions
        </h1>
        <div class="w-full h-full flex flex-col  justify-start items-end">
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
