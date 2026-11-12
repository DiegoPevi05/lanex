<section id="calculator-shipping" class="relative w-full h-auto bg-white py-16 sm:py-24 text-slate-900 z-10 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col justify-start items-start">
        <div class="w-full flex lg:flex-row flex-col justify-between items-start lg:items-end gap-6">
            <div class="flex flex-col gap-2 max-w-2xl">
                <span class="text-xs font-bold uppercase tracking-widest text-primary block mb-1">
                    {{ __('ESTIMADOR DE TRÁNSITO INTERNACIONAL') }}
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight leading-tight">
                    {{ __('Calcula los tiempos de tránsito de tu flete') }}
                </h2>
                <p class="text-slate-600 text-sm sm:text-base font-normal leading-relaxed">
                    {{ __('messages.search_shipment.helper_text') }}
                </p>
            </div>
            <div class="hidden lg:flex items-center gap-3 text-xs font-normal text-slate-600 bg-slate-50 px-4 py-2.5 rounded-lg border border-slate-200">
                <span class="font-bold text-slate-800">{{ __('Frecuencias Semanales') }}</span>
                <span class="w-px h-3.5 bg-slate-300"></span>
                <span>{{ __('Rutas Hub: Asia, EE. UU. y Sudamérica') }}</span>
            </div>
        </div>

        <div class="w-full mt-8">
            <!-- Command Inputs Box -->
            <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-4 items-stretch">
                <!-- Origin Selector -->
                <div class="relative md:col-span-1 lg:col-span-5 cursor-pointer trigger-origin bg-white hover:bg-slate-50/80 border border-slate-200/90 rounded-xl p-4 flex items-center justify-between transition-all shadow-xs min-h-[72px]">
                    <div class="flex flex-col select-none">
                        <span class="text-[11px] font-normal uppercase tracking-wider text-slate-500">{{ __('messages.search_shipment.origin') }}</span>
                        <span class="origin-selected text-base font-bold text-slate-900 mt-0.5">China</span>
                    </div>
                    <span class="btn-list btn-origin p-2 rounded-lg bg-slate-50 text-slate-600 border border-slate-200/60 shadow-2xs shrink-0">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </span>
                    <div class="origin-select-dropdown absolute w-full max-h-[320px] top-[105%] left-0 bg-white shadow-xl rounded-xl border border-slate-200 overflow-y-auto z-[120] p-1.5 flex flex-col modal-select-hide">
                    </div>
                </div>

                <!-- Destination Selector -->
                <div class="relative md:col-span-1 lg:col-span-5 cursor-pointer trigger-destiny bg-white hover:bg-slate-50/80 border border-slate-200/90 rounded-xl p-4 flex items-center justify-between transition-all shadow-xs min-h-[72px]">
                    <div class="flex flex-col select-none">
                        <span class="text-[11px] font-normal uppercase tracking-wider text-slate-500">{{ __('Destino') }}</span>
                        <span class="destiny-selected text-base font-bold text-slate-900 mt-0.5">{{ __('Perú') }}</span>
                    </div>
                    <span class="btn-list btn-destiny p-2 rounded-lg bg-slate-50 text-slate-600 border border-slate-200/60 shadow-2xs shrink-0">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </span>
                    <div class="destiny-select-dropdown absolute w-full max-h-[320px] top-[105%] left-0 bg-white shadow-xl rounded-xl border border-slate-200 overflow-y-auto z-[120] p-1.5 flex flex-col modal-select-hide">
                    </div>
                </div>

                <!-- Calculate CTA Button -->
                <div class="md:col-span-2 lg:col-span-2 w-full flex">
                    <button type="button" class="calculate-btn taste-btn w-full h-[72px] bg-primary hover:bg-primary-dark text-white font-bold text-sm tracking-wide px-6 rounded-xl shadow-md shadow-primary/20 flex items-center justify-center gap-2.5 cursor-pointer uppercase shrink-0 group">
                        <span>{{ __('messages.search_shipment.calculate') }}</span>
                        <svg class="w-4 h-4 shrink-0 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

            <!-- Scroll-Driven Flight Trajectory Bar -->
            <div id="scroll-flight-track" class="w-full mt-8 py-6 px-5 sm:px-8 bg-slate-50/70 border border-slate-200 rounded-xl select-none">
                <div class="flex items-center justify-between text-xs text-slate-500 mb-4">
                    <div class="flex items-center gap-2">
                        <span class="font-mono uppercase tracking-wider text-slate-400">{{ __('ORIGEN') }}</span>
                        <strong id="flight-origin-name" class="text-sm font-bold text-slate-900">{{ __('China') }}</strong>
                    </div>
                    <span id="flight-status-label" class="hidden sm:inline-block font-mono text-[11px] uppercase tracking-wider text-slate-500">
                        {{ __('Trayectoria de tránsito internacional') }}
                    </span>
                    <div class="flex items-center gap-2 text-right">
                        <strong id="flight-destiny-name" class="text-sm font-bold text-slate-900">{{ __('Perú') }}</strong>
                        <span class="font-mono uppercase tracking-wider text-slate-400">{{ __('DESTINO') }}</span>
                    </div>
                </div>

                <!-- Horizontal Track Line with Scroll-Linked Plane -->
                <div class="relative w-full py-3 flex items-center">
                    <!-- Base Track -->
                    <div class="w-full h-[2px] bg-slate-200 relative overflow-hidden rounded-full">
                        <div id="flight-progress-bar" class="h-full bg-primary transition-[width] duration-150 ease-out" style="width: 15%;"></div>
                    </div>

                    <!-- Origin Node -->
                    <div class="w-3 h-3 rounded-full bg-white border-2 border-primary absolute left-0 -translate-y-1/2 top-1/2 z-10"></div>

                    <!-- Scroll-Linked Airplane Carrier -->
                    <div
                        id="flight-plane-element"
                        class="absolute top-1/2 -translate-y-1/2 -translate-x-1/2 z-20 transition-[left] duration-150 ease-out will-change-[left]"
                        style="left: 15%;"
                    >
                        <div class="w-9 h-9 rounded-full bg-white border border-slate-200 shadow-sm flex items-center justify-center text-primary">
                            <svg class="w-5 h-5 rotate-90" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Destination Node -->
                    <div class="w-3 h-3 rounded-full bg-white border-2 border-slate-400 absolute right-0 -translate-y-1/2 top-1/2 z-10" id="flight-destiny-node"></div>
                </div>
            </div>

            <!-- Empty Route Fallback -->
            <div id="empty-options-content" class="w-full border border-slate-200 rounded-xl bg-slate-50/50 py-10 px-6 mt-6 text-center hidden">
                <h3 class="font-bold text-slate-900 text-base">{{ __('messages.search_shipment.empty_content') }}</h3>
                <p class="text-sm text-slate-600 mt-1 max-w-md mx-auto">
                    {{ __('Para este origen y destino operamos bajo cotización spot a medida. Solicita el itinerario directo con nuestro equipo operativo.') }}
                </p>
                <div class="mt-4">
                    <a href="{{ route('quote') }}" class="taste-btn inline-flex items-center gap-2 h-11 px-5 rounded-lg bg-primary text-white text-xs font-semibold">
                        <span>{{ __('Solicitar cotización directa') }}</span>
                        <svg class="w-4 h-4 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Architectural Transit Schedule Result -->
            <div id="shipment-options" class="w-full mt-6 border border-slate-200 rounded-xl bg-white overflow-hidden">
                <!-- Schedule Header Bar -->
                <div class="bg-slate-50/90 border-b border-slate-200 px-6 py-3.5 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-mono uppercase tracking-wider text-slate-500">{{ __('RUTA CONSULTADA') }}</span>
                        <span class="w-px h-3.5 bg-slate-300"></span>
                        <span id="route-confirmed-text" class="text-sm font-bold text-slate-900">China → Perú</span>
                    </div>
                    <span class="text-xs text-slate-500 font-normal">
                        {{ __('Tiempos estimados de tránsito internacional') }}
                    </span>
                </div>

                <!-- Two-Column Hairline Specification Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-slate-200">
                    <!-- Modalidad 01: Vía Aérea -->
                    <div class="p-6 sm:p-8 flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-primary block">
                                        MODALIDAD 01 · {{ __('messages.search_shipment.air') }}
                                    </span>
                                    <h3 class="text-lg font-bold text-slate-900 mt-1">
                                        {{ __('Carga Express y Consolidado Aéreo') }}
                                    </h3>
                                </div>
                                <svg class="w-5 h-5 text-slate-400 shrink-0 mt-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/></svg>
                            </div>

                            <div class="my-6 py-5 border-y border-slate-200/80 flex items-baseline justify-between gap-4">
                                <span class="text-xs uppercase tracking-wider text-slate-500 font-medium">
                                    {{ __('messages.search_shipment.estimated_time') }}
                                </span>
                                <div class="text-right">
                                    <span class="air-method-shipping-time text-3xl sm:text-4xl font-bold text-slate-900 tabular-nums tracking-tight">1-2</span>
                                    <span class="text-sm font-normal text-slate-600 ml-1">{{ __('messages.search_shipment.weeks') }}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 text-xs text-slate-600 mb-6">
                                <div>
                                    <span class="text-slate-400 block">{{ __('Terminal de arribo / salida') }}</span>
                                    <strong class="text-slate-800 font-semibold mt-0.5 block">{{ __('Aeropuerto Jorge Chávez (LIM)') }}</strong>
                                </div>
                                <div>
                                    <span class="text-slate-400 block">{{ __('Frecuencia operativa') }}</span>
                                    <strong class="text-slate-800 font-semibold mt-0.5 block">{{ __('Salidas regulares por semana') }}</strong>
                                </div>
                            </div>
                        </div>

                        <a data-method="air" class="taste-btn w-full h-11 px-5 bg-primary hover:bg-primary-dark text-white text-xs font-semibold rounded-lg cursor-pointer flex items-center justify-between group">
                            <span>{{ __('messages.search_shipment.quote') }} flete aéreo</span>
                            <svg class="w-4 h-4 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                    </div>

                    <!-- Modalidad 02: Vía Marítima -->
                    <div class="p-6 sm:p-8 flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-slate-500 block">
                                        MODALIDAD 02 · {{ __('messages.search_shipment.sea') }}
                                    </span>
                                    <h3 class="text-lg font-bold text-slate-900 mt-1">
                                        {{ __('Contenedor FCL y Consolidado LCL') }}
                                    </h3>
                                </div>
                                <svg class="w-5 h-5 text-slate-400 shrink-0 mt-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M2 21c.6.5 1.2 1 2.5 1 2.5 0 2.5-2 5-2 1.3 0 1.9.5 2.5 1 .6.5 1.2 1 2.5 1 2.5 0 2.5-2 5-2 1.3 0 1.9.5 2.5 1"/><path d="M19.38 20A11.6 11.6 0 0 0 21 14l-9-4-9 4c0 2.9.94 5.34 2.81 7.76"/><path d="M19 13V7a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v6"/><line x1="12" y1="2" x2="12" y2="10"/></svg>
                            </div>

                            <div class="my-6 py-5 border-y border-slate-200/80 flex items-baseline justify-between gap-4">
                                <span class="text-xs uppercase tracking-wider text-slate-500 font-medium">
                                    {{ __('messages.search_shipment.estimated_time') }}
                                </span>
                                <div class="text-right">
                                    <span class="sea-method-shipping-time text-3xl sm:text-4xl font-bold text-slate-900 tabular-nums tracking-tight">4-6</span>
                                    <span class="text-sm font-normal text-slate-600 ml-1">{{ __('messages.search_shipment.weeks') }}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 text-xs text-slate-600 mb-6">
                                <div>
                                    <span class="text-slate-400 block">{{ __('Terminal portuario') }}</span>
                                    <strong class="text-slate-800 font-semibold mt-0.5 block">{{ __('Puerto del Callao (PECLL)') }}</strong>
                                </div>
                                <div>
                                    <span class="text-slate-400 block">{{ __('Modalidad de despacho') }}</span>
                                    <strong class="text-slate-800 font-semibold mt-0.5 block">{{ __('FCL exclusivo y LCL compartido') }}</strong>
                                </div>
                            </div>
                        </div>

                        <a data-method="sea" class="taste-btn w-full h-11 px-5 border border-slate-300 hover:border-slate-900 text-slate-900 bg-white hover:bg-slate-50 text-xs font-semibold rounded-lg cursor-pointer flex items-center justify-between group">
                            <span>{{ __('messages.search_shipment.quote') }} flete marítimo</span>
                            <svg class="w-4 h-4 taste-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
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

            const sectionEl = document.getElementById("calculator-shipping");
            const originDropdown = document.querySelector(".origin-select-dropdown");
            const destinyDropdown = document.querySelector(".destiny-select-dropdown");
            const originSelected = document.querySelector(".origin-selected");
            const destinySelected = document.querySelector(".destiny-selected");
            const triggerOrigin = document.querySelector(".trigger-origin");
            const triggerDestiny = document.querySelector(".trigger-destiny");

            const calculateBtn = document.querySelector(".calculate-btn");
            const emptyContent = document.getElementById("empty-options-content");
            const shipmentOptions = document.getElementById("shipment-options");

            const flightPlaneElement = document.getElementById("flight-plane-element");
            const flightProgressBar = document.getElementById("flight-progress-bar");
            const flightOriginName = document.getElementById("flight-origin-name");
            const flightDestinyName = document.getElementById("flight-destiny-name");
            const flightDestinyNode = document.getElementById("flight-destiny-node");
            const routeConfirmedText = document.getElementById("route-confirmed-text");

            const airMethodShippingTime = document.querySelector(".air-method-shipping-time");
            const seaMethodShippingTime = document.querySelector(".sea-method-shipping-time");

            let isManualCalculating = false;

            function setPlaneProgress(percent) {
                const clamped = Math.max(4, Math.min(96, percent));
                if (flightPlaneElement) {
                    flightPlaneElement.style.left = clamped + "%";
                }
                if (flightProgressBar) {
                    flightProgressBar.style.width = clamped + "%";
                }
                if (flightDestinyNode) {
                    if (clamped >= 90) {
                        flightDestinyNode.classList.remove("border-slate-400");
                        flightDestinyNode.classList.add("border-primary", "bg-primary");
                    } else {
                        flightDestinyNode.classList.add("border-slate-400");
                        flightDestinyNode.classList.remove("border-primary", "bg-primary");
                    }
                }
            }

            // Scroll-driven airplane trajectory animation
            function updatePlaneOnScroll() {
                if (!sectionEl || isManualCalculating) return;
                const rect = sectionEl.getBoundingClientRect();
                const windowHeight = window.innerHeight || document.documentElement.clientHeight;

                // Start moving when top of section enters bottom 85% of viewport,
                // reach 96% when section top reaches top 15% of viewport
                const startY = windowHeight * 0.85;
                const endY = windowHeight * 0.12;
                const rawProgress = (startY - rect.top) / (startY - endY);
                const clampedProgress = Math.max(0, Math.min(1, rawProgress));
                const percent = 4 + clampedProgress * 92;

                setPlaneProgress(percent);
            }

            let scrollTicking = false;
            window.addEventListener("scroll", function () {
                if (!scrollTicking) {
                    window.requestAnimationFrame(function () {
                        updatePlaneOnScroll();
                        scrollTicking = false;
                    });
                    scrollTicking = true;
                }
            }, { passive: true });

            function setSelected(element, countryCode, countryName) {
                element.textContent = countryName;
                element.dataset.code = countryCode;
            }

            function updateRouteDisplay() {
                const originName = originSelected.textContent.trim();
                const destinyName = destinySelected.textContent.trim();
                const selectedCountryCode = originSelected.dataset.code === PERU_CODE ? destinySelected.dataset.code : originSelected.dataset.code;
                const countryFound = CountriesData.find(country => country.code === selectedCountryCode);

                if (flightOriginName) flightOriginName.textContent = originName;
                if (flightDestinyName) flightDestinyName.textContent = destinyName;
                if (routeConfirmedText) routeConfirmedText.textContent = originName + " → " + destinyName;

                if (countryFound && (countryFound.air || countryFound.sea)) {
                    if (airMethodShippingTime) airMethodShippingTime.textContent = countryFound.air || "1-2";
                    if (seaMethodShippingTime) seaMethodShippingTime.textContent = countryFound.sea || "4-6";
                    if (emptyContent) emptyContent.classList.add("hidden");
                    if (shipmentOptions) shipmentOptions.classList.remove("hidden");
                } else {
                    if (shipmentOptions) shipmentOptions.classList.add("hidden");
                    if (emptyContent) emptyContent.classList.remove("hidden");
                }
            }

            function loadCountries(dropdown) {
                dropdown.innerHTML = "";
                CountriesData.forEach((country) => {
                    const option = document.createElement("div");
                    option.classList.add(
                        "text-sm",
                        "font-medium",
                        "w-full",
                        "py-2",
                        "px-3",
                        "rounded-lg",
                        "hover:bg-primary",
                        "hover:text-white",
                        "cursor-pointer",
                        "text-slate-700",
                        "transition-colors"
                    );
                    option.dataset.country = country.code;
                    option.textContent = country.name;
                    option.addEventListener("click", function (e) {
                        e.stopPropagation();
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
                        updateRouteDisplay();
                    });
                    dropdown.appendChild(option);
                });
            }

            setSelected(destinySelected, PERU_CODE, PERU_NAME);
            setSelected(originSelected, "CN", "China");

            loadCountries(originDropdown);
            loadCountries(destinyDropdown);
            updateRouteDisplay();
            updatePlaneOnScroll();

            function toggleDropdown(dropdown, otherDropdown) {
                dropdown.classList.toggle("modal-select-hide");
                dropdown.classList.toggle("modal-select-show");
                otherDropdown.classList.add("modal-select-hide");
                otherDropdown.classList.remove("modal-select-show");
            }

            if (triggerOrigin) {
                triggerOrigin.addEventListener("click", function (e) {
                    e.stopPropagation();
                    toggleDropdown(originDropdown, destinyDropdown);
                });
            }

            if (triggerDestiny) {
                triggerDestiny.addEventListener("click", function (e) {
                    e.stopPropagation();
                    toggleDropdown(destinyDropdown, originDropdown);
                });
            }

            document.addEventListener("click", function () {
                if (originDropdown) originDropdown.classList.add("modal-select-hide");
                if (destinyDropdown) destinyDropdown.classList.add("modal-select-hide");
            });

            document.addEventListener("keydown", function (e) {
                if (e.key === "Escape") {
                    if (originDropdown) originDropdown.classList.add("modal-select-hide");
                    if (destinyDropdown) destinyDropdown.classList.add("modal-select-hide");
                }
            });

            if (calculateBtn) {
                calculateBtn.addEventListener("click", function () {
                    isManualCalculating = true;
                    if (flightPlaneElement) {
                        flightPlaneElement.style.transition = "none";
                    }
                    if (flightProgressBar) {
                        flightProgressBar.style.transition = "none";
                    }
                    setPlaneProgress(6);

                    requestAnimationFrame(() => {
                        requestAnimationFrame(() => {
                            if (flightPlaneElement) {
                                flightPlaneElement.style.transition = "left 650ms cubic-bezier(0.2, 0.8, 0.2, 1)";
                            }
                            if (flightProgressBar) {
                                flightProgressBar.style.transition = "width 650ms cubic-bezier(0.2, 0.8, 0.2, 1)";
                            }
                            setPlaneProgress(96);
                            updateRouteDisplay();
                        });
                    });

                    setTimeout(() => {
                        if (flightPlaneElement) {
                            flightPlaneElement.style.transition = "";
                        }
                        if (flightProgressBar) {
                            flightProgressBar.style.transition = "";
                        }
                        isManualCalculating = false;
                    }, 750);
                });
            }

            const quoteButtons = document.querySelectorAll("#shipment-options a");
            quoteButtons.forEach(button => {
                button.addEventListener("click", function (event) {
                    event.preventDefault();
                    const method = this.getAttribute("data-method");
                    const origin = originSelected.textContent;
                    const destiny = destinySelected.textContent;
                    let content = method === "air" ? "{{ __('messages.search_shipment.air_text') }}" : "{{ __('messages.search_shipment.sea_text') }}";

                    const url = new URL(window.location.origin + "/quote");
                    url.searchParams.append("origin", origin);
                    url.searchParams.append("destiny", destiny);
                    url.searchParams.append("content", content);
                    window.location.href = url.toString();
                });
            });
        });
    </script>
@endpush
