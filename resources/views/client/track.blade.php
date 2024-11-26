@extends('layouts.client')


@section('content-client')
    <section id="tracking_section" class="w-full h-auto text-body pt-[80px] pt:mt-[140px] max-xl:mt-12">
        <div class="w-full h-full px-4 sm:px-24 xl:px-48 py-12 sm:py-24 xl:py-36 flex flex-col xl:flex-row justify-start items-end gap-y-6 sm:gap-x-12 xl:gap-x-24">
            <div class="w-full xl:w-2/3 h-full flex flex-col flex-start items-start gap-y-6">
                <h2 class="font-bold text-primary">{{ __('messages.track.hero.title') }}</h2>
                <form id="search_track_order" onsubmit="#" class="w-full h-auto flex flex-row justify-center items-start gap-x-4">
                    <input id="track_order" name="order" type="text"  class="w-full h-auto px-4 py-3 border-2 border-secondary-dark rounded-lg text-secondary-dark placeholder:text-secondary-dark focus:border-2 focus:border-primary focus:outline-none font-bold" placeholder="{{ __('messages.track.hero.input_placeholder') }}" />
                    <button type="submit" class="bg-primary-dark px-12 py-3 h-full text-white font-bold duration-300 active:scale-95 rounded-xl hover:bg-secondary-dark mx-auto">
                        <span>{{ __('messages.track.hero.input_button') }}</span>
                    </button>
                </form>
                <div class="w-full h-full border-2 border-gray-light rounded-xl animation-element slide-in-up">
                    <div class="w-full h-auto flex flex-row justify-between items-center border-b-2 border-gray-light px-4 py-2">
                        <div class="w-auto h-auto flex flex-row">
                            <span class="font-bold">
                                {{ __('messages.track.order.brand_label') }}:
                            </span>
                            <span class="fontb-bold text-secondary-dark">
                                Zeus
                            </span>
                        </div>
                        <div class="w-auto flex flex-row">
                            <label class="font-bold text-secondary-dark">
                                ID: 12341231231
                            </label>
                        </div>
                    </div>
                    <div class="w-full h-auto flex flex-col justify-start items-start border-b-2 border-gray-light px-4 py-4">
                        <div class="w-full flex flex-row">
                            <div class="w-1/2 h-full flex flex-col justify-start items-start">
                                <p class="text-secondary-dark">
                                {{ __('messages.track.order.shipment') }}:
                                </p>
                            </div>
                            <div class="w-1/2 h-full flex flex-col justify-start items-end">
                                <span class="w-auto h-auto flex flex-row gap-x-4">
                                    <x-bi-airplane-fill class="text-primary h-6 w-6"/>
                                    <p class="font-bold text-secondary-dark">
                                        {{ __('messages.track.order.air_ship') }}:
                                    </p>
                                </span>
                            </div>
                        </div>
                        <div class="w-full flex flex-row mt-2 h-16">
                            <div class="grid grid-cols-2 grid-rows-span w-1/2 lg:w-1/4 relative ">
                                <div class="col-span-1 flex justify-center items-center">
                                    <p>{{ __('messages.track.order.origin') }}</p>
                                </div>
                                <div class="col-span-1 text-secondary-dark flex justify-center items-center">
                                    <p>Corea</p>
                                </div>
                                <div class="col-span-1 flex justify-center items-center">
                                    <p>{{ __('messages.track.order.destiny') }}</p>
                                </div>
                                <div class="col-span-1 text-secondary-dark flex justify-center items-center">
                                    <p>Hong Kong</p>
                                </div>
                                <div class="absolute w-[2px] h-[80%] bg-primary left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">
                                    <div class="absolute w-[10px] h-[10px] bg-primary rounded-xl top-0 -translate-x-1/2"></div>
                                    <div class="absolute w-[10px] h-[10px] bg-primary rounded-xl bottom-0 -translate-x-1/2"></div>
                                </div>
                            </div>
                            <div class="w-2/4 lg:w-3/4 h-full flex flex-col justify-start items-end gap-y-4">
                                <p class="text-secondary-dark">{{ __('messages.track.order.destiny_city') }}</p>
                                <span class="bg-primary rounded-xl w-auto px-4"><p class="text-white">New York</p></span>

                            </div>
                        </div>
                    </div>

                    <div class="w-full h-auto flex flex-col justify-start items-center px-4 py-4">
                        <label class="font-bold text-primary w-auto">{{ __('messages.track.order.order_details') }}</label>
                        <div class="w-full h-auto grid grid-cols-2 px-4 gap-6 mt-6">
                            <div class="col-span-1 h-auto flex flex-col ">
                                <div class="flex flex-col w-full h-auto">
                                    <div class="flex flex-row w-full h-auto gap-x-2">
                                        <x-bi-airplane-fill class="text-primary h-6 w-6"/>
                                        <p class="font-bold text-secondary-dark">
                                            {{ __('messages.track.order.number_flight') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-row justify-start items-center border-b-2 border-primary text-secondary-dark py-2">
                                        12312312312312
                                    </div>
                                </div>

                            </div>
                            <div class="col-span-1 h-auto flex flex-col ">
                                <div class="flex flex-col w-full h-auto">
                                    <div class="flex flex-row w-full h-auto gap-x-2">
                                        <x-mdi-package-variant-closed class="text-primary h-6 w-6"/>
                                        <p class="font-bold text-secondary-dark">
                                            Packing List
                                        </p>
                                    </div>
                                    <div class="flex flex-row justify-start items-center border-b-2 border-primary text-secondary-dark py-2">
                                        12312312312312
                                    </div>
                                </div>

                            </div>
                            <div class="col-span-1 h-auto flex flex-col ">
                                <div class="flex flex-col w-full h-auto">
                                    <div class="flex flex-row w-full h-auto gap-x-2">
                                        <x-bi-calendar class="text-primary h-6 w-6"/>
                                        <p class="font-bold text-secondary-dark">
                                            {{ __('messages.track.order.departure_date') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-row justify-start items-center border-b-2 border-primary text-secondary-dark py-2">
                                            12 Aug 2024 12:00:00 GMT-5
                                    </div>
                                </div>

                            </div>
                            <div class="col-span-1 h-auto flex flex-col ">
                                <div class="flex flex-col w-full h-auto">
                                    <div class="flex flex-row w-full h-auto gap-x-2">
                                        <x-bi-calendar-check class="text-primary h-6 w-6"/>
                                        <p class="font-bold text-secondary-dark">
                                            {{ __('messages.track.order.arrival_date') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-row justify-start items-center border-b-2 border-primary text-secondary-dark py-2">
                                            12 Aug 2024 12:00:00 GMT-5
                                    </div>
                                </div>

                            </div>
                            <div class="col-span-1 h-auto flex flex-col ">
                                <div class="flex flex-col w-full h-auto">
                                    <div class="flex flex-row w-full h-auto gap-x-2">
                                        <x-heroicon-s-home class="text-primary h-6 w-6"/>
                                        <p class="font-bold text-secondary-dark">
                                            {{ __('messages.track.order.arrival_address') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-row justify-start items-center border-b-2 border-primary text-secondary-dark py-2">
                                            San Miguel , Lima , Peru
                                    </div>
                                </div>

                            </div>
                            <div class="col-span-1 h-auto flex flex-col ">
                                <div class="flex flex-col w-full h-auto">
                                    <div class="flex flex-row w-full h-auto gap-x-2">
                                        <x-bi-building class="text-primary h-6 w-6"/>
                                        <p class="font-bold text-secondary-dark">
                                            {{ __('messages.track.order.supplier_identifier') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-row justify-start items-center border-b-2 border-primary text-secondary-dark py-2">
                                        1231231231231312
                                    </div>
                                </div>

                            </div>

                            <div class="col-span-1 h-auto flex flex-col ">
                                <div class="flex flex-col w-full h-auto">
                                    <div class="flex flex-row w-full h-auto gap-x-2">
                                        <x-bi-building class="text-primary h-6 w-6"/>
                                        <p class="font-bold text-secondary-dark">
                                            {{ __('messages.track.order.client_identifier') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-row justify-start items-center border-b-2 border-primary text-secondary-dark py-2">
                                        1231231231231312
                                    </div>
                                </div>

                            </div>

                            <div class="col-span-1 h-auto flex flex-col ">
                                <div class="flex flex-col w-full h-auto">
                                    <div class="flex flex-row w-full h-auto gap-x-2">
                                        <x-mdi-package-variant-closed class="text-primary h-6 w-6"/>
                                        <p class="font-bold text-secondary-dark">
                                            {{ __('messages.track.order.product_identifier') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-row justify-start items-center border-b-2 border-primary text-secondary-dark py-2">
                                            12312312312312
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="w-full h-auto px-4 py-12">
                            <x-step-tracker type="ship" step="3"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full xl:w-1/3 h-[400px] xl:h-[800px] flex flex-col flex-start items-start gap-y-6 animation-element slide-in-up">
                <h3 class="font-bold text-primary-dark">{{ __('messages.track.order.live_tracking') }}</h3>
                <div id="map" class="w-full h-full rounded-xl bg-primary border-2 border-gray-light">
                </div>
            </div>
        </div>
    </section>
    <x-questions title="{{ __('messages.track.questions') }}" :questions="$questions" />

    <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "{{ env('GOOGLE_MAPS_API_KEY') }}", v: "weekly"});</script>
    <!-- Move script here -->
    <script>
        // Initialize and add the map
        let typeTransport = 'airplaine';
        let map;

        async function initMap() {
          // The location of Uluru
        const position = { lat: -12.046374, lng: -77.042793 };
        // A marker with a with a URL pointing to a PNG.
        const iconTransport = document.createElement("img");

        iconTransport.src = typeTransport == 'ship' ? "storage/images/web/ship_map.svg" : "storage/images/web/aircraft.svg";
        iconTransport.height = typeTransport == 'ship' ? 48 : 96; // or any desired value
        iconTransport.width = typeTransport == 'ship' ? 48 : 96;

          // Request needed libraries.
          //@ts-ignore
          const { Map } = await google.maps.importLibrary("maps");
          const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

          // The map, centered at Uluru
          map = new Map(document.getElementById("map"), {
            zoom: 3,
            center: position,
            gestureHandling: "none",
            zoomControl: false,
            mapId: "DEMO_MAP_ID",
          });

        const beachFlagMarkerView = new AdvancedMarkerElement({
          map,
          position: position,
          content: iconTransport,
          title: "A marker using a custom PNG Image",
        });
        }

        initMap();

        document.getElementById('search_track_order').addEventListener('submit', async function(e) {
            e.preventDefault();  // Prevent the default form submission

            // Get the input value
            const flightId = document.getElementById('track_order').value;

            try {
                // Make the AJAX request to track the flight
                const response = await fetch(`/track-flight?flightId=${flightId}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    console.log(response)
                    throw new Error('Failed to track flight');
                }

                // Parse the JSON response
                const result = await response.json();

                // Log the data to the console
                console.log(result);

            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>
@endsection


