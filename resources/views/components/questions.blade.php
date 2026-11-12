<section id="questions" class="w-full h-auto py-16 sm:py-24 bg-white text-slate-800 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col justify-start items-start">
        <div class="flex flex-col gap-2 mb-8">
            <span class="text-xs font-bold uppercase tracking-widest text-primary block mb-1">{{ __('SOPORTE Y DUDAS FRECUENTES') }}</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight">
                {{$title}}
            </h2>
        </div>
        <div class="w-full flex flex-col justify-start items-start border-t border-slate-200/80">
            @foreach ($questions as $question)
                <x-question
                    :id="$loop->index"
                    :question="$question['question']"
                    :answer="$question['answer']"
                />
            @endforeach
        </div>
    </div>
</section>
