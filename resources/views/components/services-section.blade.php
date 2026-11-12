<section id="services" class="w-full bg-slate-50 text-slate-900 border-b border-slate-200/80 py-16 sm:py-24">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col">
    <div class="max-w-2xl flex flex-col gap-2 mb-12">
      <span class="text-xs font-bold uppercase tracking-widest text-primary block mb-1">
        {{ __('SOLUCIONES LOGÍSTICAS ESPECIALIZADAS') }}
      </span>
      <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight leading-tight">
        {{ __('messages.home.services.title') }}
      </h2>
      <p class="text-slate-600 text-base font-normal leading-relaxed">
        {{ __('Servicios integrales para asegurar el flujo continuo de tus mercancías con tarifas competitivas, cobertura global y asesoría aduanera permanente.') }}
      </p>
    </div>

    <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
      @foreach ($services as $service)
        @php
            $wc = is_array($service['webcontent']) ? $service['webcontent'] : json_decode($service['webcontent'], true);
            $img = $wc['image'] ?? null;
        @endphp
        <div class="min-w-0 h-full">
          <x-service-card
            :id="$service['id']"
            :name="$service['name']"
            :description="$service['short_description']"
            :icon="$service['icon']"
            :image="$img"
          />
        </div>
      @endforeach
    </div>
  </div>
</section>
