<section id="calculator-shipping" class="relative w-full h-auto bg-white text-body animation-group z-10 capitalize">
    <div class="relative w-full h-auto padding flex flex-col justify-start items-start">
        <div class="w-full h-auto flex sm:flex-row flex-col justify-start sm:justify-between items-start sm:items-center gap-y-2">
            <h2 class="font-bold text-primary-dark animation-element slide-in-up text-3xl sm:text-5xl">
                {{__('messages.search_shipment.title')}}
            </h2>
            <img src="{{ asset('storage/' . '/images/web/delivery.svg' ) }}" class="h-24 sm:h-48 w-auto ml-auto"/>
        </div>
        <div class="w-full h-auto flex flex-col justify-start items-start mt-12 sm:mt-24 animation-element slide-in-up">
            <div class="w-full h-auto grid grid-col-4 sm:grid-cols-3 gap-2">
                <span class="relative col-span-2 sm:col-span-1 h-auto bg-white text-center border border-gray-300 rounded-md flex items-center justify-between gap-x-2 flex-row p-4 z-[100]">
                    <span class="inline-flex max-sm:flex-col items-center gap-x-2">
                        <h5>{{__('messages.search_shipment.origin')}}:</h5>
                        <h5 class="origin-selected"></h5>
                    </span>
                    <span class="btn-list btn-origin h-6 w-6 hover:text-primary active:scale-95 duration-300 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </span>
                    <div class="origin-select-dropdown absolute w-full max-h-[400px] top-[100%] bg-white shadow-lg left-0 overflow-y-scroll border border-gray-light rounded-b-md flex flex-col modal-select-hide">
                    </div>
                </span>
                <span class="relative col-span-2 sm:col-span-1 h-auto bg-white text-center border border-gray-300 rounded-md flex items-center justify-between gap-x-2 flex-row p-4 z-[100]">

                    <span class="inline-flex max-sm:flex-col items-center gap-x-2">
                        <h5>{{ __('messages.search_shipment.destiny') }}:</h5>
                        <h5 class="destiny-selected">Destiny</h5>
                    </span>
                    <button class="btn-list btn-destiny h-6 w-6 hover:text-primary active:scale-95 duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </button>
                    <div class="destiny-select-dropdown absolute w-full max-h-[400px] top-[100%] bg-white shadow-lg left-0 overflow-y-scroll border border-gray-light rounded-b-md flex flex-col modal-select-hide">
                    </div>
                </span>
                <button class="calculate-btn w-full col-span-4 sm:col-span-1 bg-primary text-white text-xl font-bold active:scale-95 hover:bg-white hover:text-primary duration-300 transition-all border-2 border-primary rounded-md py-2 capitalize">{{ __('messages.search_shipment.calculate') }}</button>
            </div>

            <!-- Options Calculated  loader-->
            <div id="loader-options-content" class="w-full h-auto flex justify-center items-center animate-spin text-primary hidden mt-12">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 sm:h-20 w-10 sm:w-20 lucide lucide-loader-circle"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
            </div>
            <!-- Options Calculated empty -->
            <div id="empty-options-content" class="w-full h-auto flex flex-col items-center justify-center gap-y-12 hidden mt-12">
                <h5 class="font-bold text-primary">{{__('messages.search_shipment.empty_content')}}</h5>
                <img src="{{ asset('storage/' . '/images/web/schedule.svg' ) }}" class="h-24 sm:h-48 w-auto"/>
            </div>
            <!-- Options Calculated options -->
            <div id="shipment-options" class="w-full h-auto mt-12 hidden shipment-options-show">
                <h3 class="font-bold text-primary-dark text-3xl">{{ __('messages.search_shipment.shipping_time') }}</h3>
                <div class="w-full h-auto flex flex-col justify-start items-start mt-4 gap-y-2">
                        <div class="w-full h-auto border-2 border-gray-light shadow-md rounded-lg p-4 grid grid-cols-4 sm:grid-cols-3 gap-6 items-center ">
                            <span class="text-sm sm:text-lg col-span-2 sm:col-span-1 text-center inline-flex max-sm:flex-col max-sm:justify-start max-sm:items-center gap-x-2">{{ __('messages.search_shipment.estimated_time') }}: <p class="air-method-shipping-time text-sm sm:text-lg"></p> {{ __('messages.search_shipment.weeks') }}</span>
                            <h5 class="text-sm sm:text-lg col-span-2 sm:col-span-1 text-center">{{ __('messages.search_shipment.shipping_method') }}: {{ __('messages.search_shipment.air') }}</h5>
                            <a class="text-xl h-full w-auto bg-primary rounded-lg col-span-4 sm:col-span-1 text-white text-center cursor-pointer py-2 hover:bg-white border-2 border-primary hover:text-primary active:scale-95 duration-300 transition-all capitalize" data-method="air">{{ __('messages.search_shipment.quote') }}</a>
                        </div>

                        <div class="w-full h-auto border-2 border-gray-light shadow-md rounded-lg p-4 grid grid-cols-4 sm:grid-cols-3 gap-6 items-center ">
                            <span class="text-sm sm:text-lg col-span-2 sm:col-span-1 text-center inline-flex max-sm:flex-col max-sm:justify-start max-sm:items-center gap-x-2">{{ __('messages.search_shipment.estimated_time') }}: <p class="sea-method-shipping-time text-sm sm:text-lg"></p> {{ __('messages.search_shipment.weeks') }}</span>
                            <h5 class="text-sm sm:text-lg col-span-2 sm:col-span-1 text-center">{{ __('messages.search_shipment.shipping_method') }}: {{ __('messages.search_shipment.sea') }}</h5>
                            <a class="text-xl h-full w-auto bg-primary rounded-lg col-span-4 sm:col-span-1 text-white text-center cursor-pointer py-2 hover:bg-white border-2 border-primary hover:text-primary active:scale-95 duration-300 transition-all capitalize" data-method="sea">{{ __('messages.search_shipment.quote') }}</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
    <script>

        document.addEventListener("DOMContentLoaded", function () {
            let CountriesData = {!! json_encode($countries) !!};
            const PERU_CODE = "PE";
            const PERU_NAME = "Peru";

            const originDropdown = document.querySelector(".origin-select-dropdown");
            const destinyDropdown = document.querySelector(".destiny-select-dropdown");
            const originSelected = document.querySelector(".origin-selected");
            const destinySelected = document.querySelector(".destiny-selected");

            const calculateBtn = document.querySelector(".calculate-btn");

            const loaderContent = document.getElementById("loader-options-content");
            const emptyContent = document.getElementById("empty-options-content");
            const shipmentOptions = document.getElementById("shipment-options");

            const airMethodShippingTime = document.querySelector(".air-method-shipping-time");
            const seaMethodShippingTime = document.querySelector(".sea-method-shipping-time");

            // Function to set a selected country
            function setSelected(element, countryCode, countryName) {
                element.textContent = countryName;
                element.dataset.code = countryCode;
            }

            // Function to populate dropdowns
            function loadCountries(dropdown) {
                dropdown.innerHTML = "";
                CountriesData.forEach((country) => {
                    const option = document.createElement("span");
                    option.classList.add(
                        "text-lg",
                        "w-full",
                        "py-2",
                        "hover:bg-primary",
                        "hover:text-white",
                        "cursor-pointer",
                        "text-primary",
                        "duration-300"
                    );
                    option.dataset.country = country.code;
                    option.textContent = country.name;
                    option.addEventListener("click", function () {
                        if (dropdown === originDropdown) {
                            if (country.code === PERU_CODE) {
                                setSelected(originSelected, PERU_CODE, PERU_NAME);
                            } else {
                                setSelected(originSelected, country.code, country.name);
                                setSelected(destinySelected, PERU_CODE, PERU_NAME);
                            }
                        } else {
                            if (country.code === PERU_CODE) {
                                setSelected(destinySelected, PERU_CODE, PERU_NAME);
                            } else {
                                setSelected(destinySelected, country.code, country.name);
                                setSelected(originSelected, PERU_CODE, PERU_NAME);
                            }
                        }
                        dropdown.classList.add("modal-select-hide");
                        dropdown.classList.remove("modal-select-show");
                    });
                    dropdown.appendChild(option);
                });
            }

            // Set Peru as the default selected option for destiny
            setSelected(destinySelected, PERU_CODE, PERU_NAME);
            setSelected(originSelected, "CN", "China");

            // Load countries into both dropdowns
            loadCountries(originDropdown);
            loadCountries(destinyDropdown);

            // Toggle dropdown visibility
            function toggleDropdown(dropdown, otherDropdown) {
                dropdown.classList.toggle("modal-select-hide");
                dropdown.classList.toggle("modal-select-show");
                otherDropdown.classList.add("modal-select-hide");
                otherDropdown.classList.remove("modal-select-show");
            }

            document.querySelector(".btn-origin").addEventListener("click", function () {
                toggleDropdown(originDropdown, destinyDropdown);
            });

            document.querySelector(".btn-destiny").addEventListener("click", function () {
                toggleDropdown(destinyDropdown, originDropdown);
            });

            calculateBtn.addEventListener("click", function () {
                let selectedCountryCode, selectedCountryName;

                if (originSelected.dataset.code === PERU_CODE) {
                    selectedCountryCode = destinySelected.dataset.code;
                    selectedCountryName = destinySelected.textContent;
                } else {
                    selectedCountryCode = originSelected.dataset.code;
                    selectedCountryName = originSelected.textContent;
                }

                const countryFound = CountriesData.find(country => country.code === selectedCountryCode);

                // Start the search: Show loader, hide results
                loaderContent.classList.remove("hidden");
                emptyContent.classList.add("hidden");
                shipmentOptions.classList.add("hidden");

                setTimeout(() => {
                    loaderContent.classList.add("hidden");

                    if (countryFound) {
                        airMethodShippingTime.textContent = countryFound.air;
                        seaMethodShippingTime.textContent = countryFound.sea;
                        shipmentOptions.classList.remove("hidden");
                    } else {
                        emptyContent.classList.remove("hidden");
                    }
                }, 500);
            });
            // Add event listeners to the quote buttons
            const quoteButtons = document.querySelectorAll("#shipment-options a");
            quoteButtons.forEach(button => {
                button.addEventListener("click", function (event) {
                    event.preventDefault(); // Prevent default anchor behavior

                    // Get the shipping method from the data-method attribute
                    const method = this.getAttribute("data-method");
                    // Get origin and destiny from their respective elements
                    const origin = originSelected.innerHTML;
                    const destiny = destinySelected.innerHTML;
                    let content  = null;
                    if(method === "air"){
                        content = "{{ __('messages.search_shipment.air_text') }}";
                    }else{
                        content = "{{ __('messages.search_shipment.sea_text') }}";
                    }


                    // Construct the URL with query parameters
                    const url = new URL(window.location.origin + "/quote");
                    url.searchParams.append("origin", origin);
                    url.searchParams.append("destiny", destiny);
                    url.searchParams.append("content", content);

                    // Redirect to the constructed URL
                    window.location.href = url.toString();
                });
            });
        });
    </script>
