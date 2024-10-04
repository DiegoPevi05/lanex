@extends('layouts.client')


@section('content-client')
    <section id="tracking_section" class="w-full h-screen bg-white text-body pt-[80px] pt:mt-[140px]">
        <div class="w-full h-full padding flex flex-col xl:flex-row justify-start items-end gap-y-6 sm:gap-x-12 xl:gap-x-24">
            <div class="w-2/3 h-full flex flex-start items-start gap-y-6">
                <form id="search_track_order" onsubmit="#" class="w-full h-auto flex flex-row justify-center items-start gap-x-4">
                    <input id="track_order" name="order" type="text"  class="w-full h-auto px-4 py-3 border-2 border-secondary-dark rounded-lg text-secondary-dark placeholder:text-secondary-dark focus:border-2 focus:border-primary focus:outline-none font-bold" placeholder="Orden ID" />
                    <button type="submit" class="bg-primary-dark px-12 py-3 h-full text-white font-bold duration-300 active:scale-95 rounded-xl hover:bg-secondary-dark mx-auto">
                        <span>Buscar</span>
                    </button>
                </form>
            </div>
            <div class="w-1/3 h-full flex flex-col flex-start items-start gap-y-6">
                <h3 class="font-bold text-primary-dark">Live Tracking</h3>
                <div id="map_tracker" class="w-full h-full rounded-xl bg-primary border-2 border-gray-light">

                </div>
            </div>
        </div>
    </section>
    <x-questions title="Frequently asked questions" :questions="$questions" />

    <!-- Move script here -->
    <script>
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


