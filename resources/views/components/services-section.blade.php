<section id="services" class="w-full h-screen bg-white text-body">
    <div class="relative w-full h-full padding flex flex-col justify-center items-center">
        <h5>Nuestros Servicios</h5>
        <h1 class="font-bold text-primary-dark">
            Entrega Eficiente y confiable en cualquiera de nuestros servicios
        </h1>

        <div class="h-full w-full grid grid-cols-3 grid-rows-2 gap-12 p-12">
            @foreach ($services as $service)
                <x-service-card
                    :route="$service['route']"
                    :header="$service['header']"
                    :content="$service['content']"
                    :svgIcon="$service['svgIcon']"
                />
            @endforeach
        </div>
    </div>
</section>
