<!-- resources/views/components/pillars-section.blade.php -->
<section id="pillars_section" class="w-full bg-white text-slate-900 py-16 sm:py-24 border-b border-slate-200/80" data-scroll-title="{{ __('Pilares') }}">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col">
        <div class="max-w-2xl mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-primary block mb-2">
                {{ __('messages.about.pillars.header') }}
            </span>
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight leading-tight">
                {{ __('messages.about.pillars.title') }}
            </h2>
        </div>

        <div class="w-full grid grid-cols-1 md:grid-cols-3 border-t border-slate-200 divide-y md:divide-y-0 md:divide-x divide-slate-200">
            <!-- Pillar 1 -->
            <div class="flex flex-col items-start py-8 md:pr-8 lg:pr-10">
                <div class="w-full flex items-center justify-between mb-6">
                    <span class="text-xs font-mono font-bold text-primary tracking-wider">{{ __('PILAR 01') }}</span>
                    <x-heroicon-o-book-open class="w-5 h-5 text-slate-700" />
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3 tracking-tight">
                    {{ __('messages.about.pillars.items.knowledge.title') }}
                </h3>
                <p class="text-base text-slate-600 leading-relaxed font-normal">
                    {{ __('messages.about.pillars.items.knowledge.content') }}
                </p>
            </div>

            <!-- Pillar 2 -->
            <div class="flex flex-col items-start py-8 md:px-8 lg:px-10">
                <div class="w-full flex items-center justify-between mb-6">
                    <span class="text-xs font-mono font-bold text-primary tracking-wider">{{ __('PILAR 02') }}</span>
                    <x-heroicon-o-light-bulb class="w-5 h-5 text-slate-700" />
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3 tracking-tight">
                    {{ __('messages.about.pillars.items.innovation.title') }}
                </h3>
                <p class="text-base text-slate-600 leading-relaxed font-normal">
                    {{ __('messages.about.pillars.items.innovation.content') }}
                </p>
            </div>

            <!-- Pillar 3 -->
            <div class="flex flex-col items-start py-8 md:pl-8 lg:pl-10">
                <div class="w-full flex items-center justify-between mb-6">
                    <span class="text-xs font-mono font-bold text-primary tracking-wider">{{ __('PILAR 03') }}</span>
                    <x-heroicon-o-cpu-chip class="w-5 h-5 text-slate-700" />
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3 tracking-tight">
                    {{ __('messages.about.pillars.items.technology.title') }}
                </h3>
                <p class="text-base text-slate-600 leading-relaxed font-normal">
                    {{ __('messages.about.pillars.items.technology.content') }}
                </p>
            </div>
        </div>
    </div>
</section>
