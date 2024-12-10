@section('meta_description', __('messages.meta.track'))
@extends('layouts.client')


@section('content-client')
    <section id="tracking_section" class="w-full h-auto text-body pt-[80px] pt:mt-[140px] max-xl:mt-12">
        <div class="w-full h-full px-4 sm:px-24 xl:px-48 pt-12 pb-12 sm:pt-24 xl:pt-36 flex flex-col xl:flex-row justify-start items-start gap-y-6 sm:gap-x-12 xl:gap-x-24">
            <div id="container-content-order-tracked" class="w-full h-full flex flex-col flex-start items-start gap-y-6">
                <h2 class="font-bold text-primary">{{ __('messages.track.hero.title') }}</h2>
                <form id="search_track_order" class="w-full h-auto flex flex-row justify-center items-start gap-x-4">
                    <input id="track_order" name="order" type="text"  class="w-full h-auto px-4 py-3 border-2 border-secondary-dark rounded-lg text-secondary-dark placeholder:text-secondary-dark focus:border-2 focus:border-primary focus:outline-none font-bold" placeholder="{{ __('messages.track.hero.input_placeholder') }}" />
                    <button type="submit" class="bg-primary-dark px-12 py-3 h-full text-white font-bold duration-300 active:scale-95 rounded-xl hover:bg-secondary-dark mx-auto">
                        <span>{{ __('messages.track.hero.input_button') }}</span>
                    </button>
                </form>
                <div id="default-order-tracked" class="w-full h-auto flex flex-col items-center justify-center animation-element slide-in-up py-12 gap-y-4">
                    <img src="{{ asset('storage/'. '/images/web/map.svg') }}" alt="default_track_image" class="h-auto w-[40%]"/>
                    <p>{{__('messages.track.messages.input_order_number')}}</p>
                </div>
                <div id="not-found-order-tracked" class="w-full h-auto flex flex-col items-center justify-center animation-element slide-in-up py-12 gap-y-4 hidden">
                    <img src="{{ asset('storage/'. '/images/web/404.svg') }}" alt="order_track_not_found" class="h-auto w-[40%]"/>
                    <p>{{__('messages.track.messages.order_number_not_found')}}</p>
                    <p>{{__('messages.track.messages.order_number_not_found_helper')}}  <a href="https://wa.link/s7w6z3" target="_blank" class="text-primary hover:underline" aria-label="{{__('messages.track.messages.contact_us')}}" title="{{__('messages.track.messages.contact_us')}}">{{__('messages.track.messages.contact_us')}}</a></p>
                </div>
                <div id="loader-order-tracked" class="w-full h-auto flex items-center justify-center animation-element slide-in-up py-12 hidden">
                    <span class="h-12 w-12 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="animate-spin lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                    </span>
                </div>
                <div id="content-order-tracked" class="w-full h-auto grid grid-cols-1 sm:grid-cols-2 animation-element slide-in-up hidden">
                    <div class="col-span-1 flex flex-col items-start justify-start">
                        <label id="header_track_status" class="capitalize"></label>
                        <h2 id="header_track_status_day" class="capitalize"></h2>
                        <h5 id="header_track_status_eta"></h5>
                        <span class="w-full h-4"></span>
                        <label id="sub_header_track_status" class="capitalize"></label>
                        <h5 id="track_status" class="capitalize"></h5>
                    </div>
                    <div class="col-span-1 flex flex-col items-end justify-start">
                        <label class="capitalize">{{ __('messages.track.order.order_number') }}</label>
                        <p id="tracking_id"></p>
                        <div id="tracking_steps" class="relative w-4 h-full flex flex-col justify-start items-end py-4">
                        </div>
                    </div>
                </div>

            </div>
            <div id="content-order-tracked-map" class="w-full xl:w-1/3 h-[400px] xl:h-[800px] flex flex-col flex-start items-start gap-y-6 animation-element slide-in-up hidden">
                <h3 class="font-bold text-primary-dark">{{ __('messages.track.order.live_tracking') }}</h3>
                <div id="map" class="w-full h-full rounded-xl bg-primary border-2 border-gray-light">
                </div>
            </div>
        </div>
        <div id="content-order-freights" class="w-full h-full px-4 sm:px-24 xl:px-48 pb-6 sm:pb-12 xl:pb-18 flex flex-col justify-start items-start gap-y-6 sm:gap-y-12 animation-element slide-in-up hidden">
            <div class="w-full flex flex-row justify-start items-center gap-x-4">
                <span class="h-12 w-12 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"/><path d="M12 22V12"/><path d="m3.3 7 7.703 4.734a2 2 0 0 0 1.994 0L20.7 7"/><path d="m7.5 4.27 9 5.15"/></svg>
                </span>
                <h2 class="capitalize">{{ __('messages.track.order.freight.freights') }}</h2>
            </div>
            <table class="w-full border-2 border-gray-light">
                <thead>
                    <tr class="border-2 border-gray-light">
                        <th class="border-2 border-gray-light text-center py-1 bg-secondary capitalize max-sm:text-xs">{{ __('messages.track.order.freight.freight_id') }}</th>
                        <th class="border-2 border-gray-light text-center py-1 bg-secondary capitalize max-sm:text-xs">{{ __('messages.track.order.freight.name') }}</th>
                        <th class="border-2 border-gray-light text-center py-1 bg-secondary max-sm:hidden capitalize">{{ __('messages.track.order.freight.description') }}</th>
                        <th class="border-2 border-gray-light text-center py-1 bg-secondary capitalize max-sm:text-xs">{{ __('messages.track.order.freight.origin') }}</th>
                        <th class="border-2 border-gray-light text-center py-1 bg-secondary max-sm:hidden capitalize">{{ __('messages.track.order.freight.characteristics') }}</th>
                        <th class="border-2 border-gray-light text-center py-1 bg-secondary capitalize max-sm:text-xs">{{ __('messages.track.order.freight.packages') }}</th>
                    </tr>
                </thead>
                <tbody id="freights-container">
                </tbody>
            </table>
        </div>

        <div id="content-order-tracking-steps" class="w-full h-full px-4 sm:px-24 xl:px-48 pb-12 sm:pb-24 xl:pb-36 flex flex-col justify-start items-start gap-y-6 sm:gap-y-12 animation-element slide-in-up hidden">
            <div class="w-full flex flex-row justify-start items-center gap-x-4">
                <span class="h-12 w-12 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                </span>
                <h2>{{ __('messages.track.order.tracking.tracking_of_order') }}</h2>
            </div>
            <table class="w-full border-2 border-gray-light">
                <thead>
                    <tr class="border-2 border-gray-light">
                        <th class="border-2 border-gray-light text-center py-1 bg-secondary capitalize max-sm:text-xs">{{ __('messages.track.order.tracking.tracking_id') }}</th>
                        <th class="border-2 border-gray-light text-center py-1 bg-secondary capitalize max-sm:text-xs">{{ __('messages.track.order.tracking.status') }}</th>
                        <th class="border-2 border-gray-light text-center py-1 bg-secondary capitalize max-sm:text-xs">{{ __('messages.track.order.tracking.name') }}</th>
                        <th class="border-2 border-gray-light text-center py-1 bg-secondary capitalize max-sm:hidden">{{ __('messages.track.order.tracking.country') }}</th>
                        <th class="border-2 border-gray-light text-center py-1 bg-secondary capitalize max-sm:hidden">{{ __('messages.track.order.tracking.city') }}</th>
                        <th class="border-2 border-gray-light text-center py-1 bg-secondary capitalize max-sm:text-xs">{{ __('messages.track.order.tracking.eta') }}</th>
                    </tr>
                </thead>
                <tbody id="tracking-steps-container">
                </tbody>
            </table>
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

        const track_container = document.getElementById('tracking_section');

        const default_order_content = track_container.querySelector('#default-order-tracked');
        const not_found_order_content = track_container.querySelector('#not-found-order-tracked');
        const loader_order_content =  track_container.querySelector('#loader-order-tracked');

        const container_content_order_tracked = track_container.querySelector('#container-content-order-tracked');
        const content_order_tracked = track_container.querySelector('#content-order-tracked');
        const content_order_tracked_map = track_container.querySelector('#content-order-tracked-map');
        const content_order_freights = track_container.querySelector('#content-order-freights');
        const content_order_tracking_steps = track_container.querySelector('#content-order-tracking-steps');


        async function TrackOrderNumber (order_number){

            default_order_content.classList.add('hidden')
            loader_order_content.classList.remove('hidden');

            if (!not_found_order_content.classList.contains('hidden')) {
                not_found_order_content.classList.add('hidden');
            }

            if(container_content_order_tracked.classList.contains('xl:w-2/3')){
                container_content_order_tracked.classList.remove('xl:w-2/3')
            }

            if (!content_order_tracked.classList.contains('hidden')) {
                content_order_tracked.classList.add('hidden');
            }
            if (!content_order_tracked_map.classList.contains('hidden')) {
                content_order_tracked_map.classList.add('hidden');
            }
            if (!content_order_freights.classList.contains('hidden')) {
                content_order_freights.classList.add('hidden');
            }

            if (!content_order_tracking_steps.classList.contains('hidden')) {
                content_order_tracking_steps.classList.add('hidden');
            }




            try {
                // Make the AJAX request to track the flight
                const response = await fetch(`/track/order?order_number=${order_number}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    not_found_order_content.classList.remove('hidden');
                    console.log(response)
                    throw new Error('Failed to track order');
                }

                // Parse the JSON response
                const result = await response.json();
                console.log(result)

                // Log the data to the console
                addOrderData(result.order,result.tracking_steps);
                addFreights(result.freights);
                addTrackingSteps(result.order,result.tracking_steps);
                addStepBullet(serializeOrderBulletData(result.order,result.tracking_steps));
                content_order_tracked.classList.remove('hidden');
                content_order_tracked_map.classList.remove('hidden');
                content_order_freights.classList.remove('hidden');
                content_order_tracking_steps.classList.remove('hidden');
                container_content_order_tracked.classList.add('xl:w-2/3')

                //not_found_order_content

            } catch (error) {
                console.error('Error:', error);
            } finally {
                loader_order_content.classList.add('hidden');
            }

        }


        document.getElementById('search_track_order').addEventListener('submit', async function(e) {
            e.preventDefault();  // Prevent the default form submission
            // Get the input value
            const order_number = document.getElementById('track_order').value;
            TrackOrderNumber(order_number);
        });

        function addOrderData(order,tracking_steps){



            const tracking_id_p_tag = track_container.querySelector('#tracking_id');
            tracking_id_p_tag.innerHTML = order.order_number;

            const container_info = track_container.querySelector('#content-order-tracked');
            const tracking_header_track_status  = container_info.querySelector('#header_track_status');
            const tracking_subheader_track_status  = container_info.querySelector('#sub_header_track_status');
            const tracking_track_status = container_info.querySelector('#track_status');

            if(order.status == 'PENDING'){
                tracking_header_track_status.innerHTML = "{{ __('messages.track.order.confirmation') }}";
                tracking_subheader_track_status.innerHTML = "{{ __('messages.track.order.confirmation_status') }}";
                tracking_track_status.innerHTML = "{{ __('messages.track.order.confirmed') }}";
            }else if(order.status == 'IN_TRANSIT'){
                tracking_header_track_status.innerHTML = "{{ __('messages.track.order.shipping') }}";
                tracking_subheader_track_status.innerHTML = "{{ __('messages.track.order.shipping_status') }}";
                tracking_track_status.innerHTML = "{{ __('messages.track.order.shipping') }}";
            }else{
                tracking_header_track_status.innerHTML = "{{ __('messages.track.order.delivered') }}";
                tracking_subheader_track_status.innerHTML = "{{ __('messages.track.order.delivered_status') }}";
                tracking_track_status.innerHTML = "{{ __('messages.track.order.delivered') }}";
            }

            const tracking_header_track_day  = container_info.querySelector('#header_track_status_day');

            const tracking_header_track_eta  = container_info.querySelector('#header_track_status_eta');

            let eta = new Date(order.updated_at);

            const currentLanguage = "{{ app()->getLocale() }}" === 'en' ? 'en-US' : 'es-ES';
            let dayName = eta.toLocaleDateString(currentLanguage, { weekday: 'long' });

            tracking_header_track_day.innerHTML = dayName;
            tracking_header_track_eta.innerHTML = eta.toLocaleString();

        }

        function addFreights(freights) {
            const freightsContainer = document.querySelector('#freights-container');

            // Clear any existing rows before adding new ones
            freightsContainer.innerHTML = '';

            freights.forEach((freight, index) => {
                // Create a new row
                const row = document.createElement('tr');
                row.classList.add('border-2', 'border-gray-light');

                // Add background color for even indexes
                if (index % 2 !== 0) {
                    row.classList.add('bg-gray-light');
                }

                // Create and populate cells
                const fields = [
                    freight.freight_id,
                    freight.name,
                    freight.description,
                    freight.origin,
                    `${freight.weight || 0}${freight.weight_units || ''} - ${freight.dimensions || 0}${freight.dimensions_units || ''} - ${freight.volume || 0}${freight.volume_units || ''}`,
                    freight.packages
                ];

                fields.forEach((field,index) => {
                    const cell = document.createElement('td');
                    cell.classList.add('border-2', 'border-gray-light', 'text-center', 'py-2', 'max-sm:text-xs');
                    if(index == 2 || index == 4 ){
                        cell.classList.add('max-sm:hidden');
                    }
                    cell.textContent = field; // Add field content
                    row.appendChild(cell); // Append cell to row
                });

                // Append the row to the container
                freightsContainer.appendChild(row);
            });
        }

        function addTrackingSteps(order,tracking_steps) {
            const trackingStepsContainer = document.querySelector('#tracking-steps-container');

            // Clear any existing rows before adding new ones
            trackingStepsContainer.innerHTML = '';

            tracking_steps.forEach((step, index) => {
                // Create a new row
                const row = document.createElement('tr');
                row.classList.add('border-2', 'border-gray-light');

                const eta = new Date (step.updated_at)

                let spanSvgContainer = document.createElement('span');
                spanSvgContainer.classList.add('mx-auto','h-5','w-5','sm:h-8','sm:w-8','text-gray-light','flex','items-center','justify-center');
                spanSvgContainer.innerHTML = `
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="100%"  height="100%"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-circle-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" /></svg>
                    `

                if(step.status == 'COMPLETED' ){
                    spanSvgContainer.classList.remove('text-gray-light');
                    spanSvgContainer.classList.add('text-primary');
                }

                // Create and populate cells
                const fields = [
                    order.order_number + '#' + step.sequence,
                    spanSvgContainer,
                    step.transport_type.name,
                    step.country,
                    step.city,
                    eta.toLocaleString()
                ];

                fields.forEach((field,index) => {
                    const cell = document.createElement('td');
                    cell.classList.add('border-2', 'border-gray-light', 'text-center', 'py-2', 'max-sm:text-xs');
                    if(index == 3 || index == 4 ){
                        cell.classList.add('max-sm:hidden');
                    }
                    if (field instanceof HTMLElement) {
                        cell.appendChild(field); // Append SVG container directly
                    } else {
                        cell.textContent = field; // Add field content
                    }
                    row.appendChild(cell); // Append cell to row
                });

                // Append the row to the container
                trackingStepsContainer.appendChild(row);
            });
        }


        function serializeOrderBulletData(order,tracking_steps){
            let serializedBullets = [];

            if(tracking_steps &&  tracking_steps.length > 2 ){

                const firstTrackingStep = tracking_steps.filter((item) => item.sequence == 0)[0];


                serializedBullets.push({
                    label:"{{ __('messages.track.order.from') }}",
                    location:`${firstTrackingStep.city}, ${firstTrackingStep.country}`,
                    datetime: new Date(firstTrackingStep.updated_at),
                    active: firstTrackingStep.status == 'IN_TRANSIT' ? true : false
                });

                const currentInTransit = tracking_steps.filter((item) => item.status == 'IN_TRANSIT');

                if(currentInTransit != null && currentInTransit.length > 0){
                    if(currentInTransit.sequence != firstTrackingStep.sequence ){
                        serializedBullets.push({
                            label:"{{ __('messages.track.order.on_the_way') }}",
                            location:`${currentInTransit.city}, ${currentInTransit.country}`,
                            datetime: new Date(currentInTransit.updated_at),
                            active: currentInTransit.status == 'IN_TRANSIT' ? true : false
                        });
                    }
                }

                const lastTrackingStep = tracking_steps[tracking_steps.length -1];

                serializedBullets.push({
                    label:"{{ __('messages.track.order.out_for_delivery') }}",
                    location: null,
                    datetime: null,
                    active: lastTrackingStep.status == 'IN_TRANSIT' ? true : false
                });


                serializedBullets.push({
                    label:"{{ __('messages.track.order.to') }}",
                    location:`${lastTrackingStep.city}, ${lastTrackingStep.country}`,
                    datetime: new Date(lastTrackingStep.updated_at),
                    active: lastTrackingStep.status == 'COMPLETED' ? true : false
                });

            }



            return serializedBullets;

        }

        function addStepBullet(bullets) {
            const containerSteps = document.querySelector('#tracking_steps'); // Select the container
            containerSteps.innerHTML = ''; // Clear previous content

            bullets.forEach((bullet, index) => {
                // Create the span container
                const step = document.createElement('span');
                step.classList.add('relative', 'flex', 'flex-col', 'items-end', 'justify-start', 'w-[250px]');

                // Determine the line span class
                const lineSpan = document.createElement('span');
                lineSpan.classList.add('absolute', 'h-full', 'left-0', 'w-3', 'bg-primary');
                if (index === 0) {
                    lineSpan.classList.add('rounded-t-full'); // First step
                } else if (index === bullets.length - 1) {
                    lineSpan.classList.add('rounded-b-full'); // Last step
                }

                step.appendChild(lineSpan);

                // Check if the bullet is active or not
                if (bullet.active) {
                    // Add the active circle with the checkmark
                    const activeCircle = document.createElement('span');
                    activeCircle.classList.add(
                        'absolute',
                        'h-16',
                        'w-16',
                        '-left-8',
                        'translate-x-2',
                        'top-1/2',
                        '-translate-y-1/2',
                        'bg-primary',
                        'rounded-full',
                        'flex',
                        'items-center',
                        'justify-center',
                        'text-white',
                        'p-3'
                    );

                    // Add SVG inside the active circle
                    activeCircle.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check rounded-full border-2 border-white p-2">
                            <path d="M20 6 9 17l-5-5"/>
                        </svg>
                    `;

                    step.appendChild(activeCircle);
                } else {
                    // Add the small inactive circle
                    const inactiveCircle = document.createElement('span');
                    inactiveCircle.classList.add(
                        'absolute',
                        'h-2',
                        'left-0',
                        'left-0.5',
                        'top-1/2',
                        '-translate-y-1/2',
                        'w-2',
                        'bg-white',
                        'rounded-full'
                    );

                    step.appendChild(inactiveCircle);
                }

                // Add bullet label, location, and date/time
                const label = document.createElement('p');
                label.classList.add('font-bold', 'pt-4','capitalize');
                label.textContent = bullet.label;
                step.appendChild(label);

                if(bullet.location){
                    const location = document.createElement('label');
                    location.classList.add('capitalize');
                    location.textContent = bullet.location;
                    step.appendChild(location);
                }

                if(bullet.datetime){
                    const dateTime = document.createElement('p');
                    dateTime.classList.add('pb-4');
                    dateTime.textContent = bullet.datetime.toLocaleString();
                    step.appendChild(dateTime);
                }


                // Append step to container
                containerSteps.appendChild(step);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Parse URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const order_number = urlParams.get('order');

            if (order_number) {
                // Call the function with the order number
                TrackOrderNumber(order_number);
            }
        });




    </script>
@endsection


