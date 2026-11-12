<div class="w-full h-full pe-2">
    <h5 class="font-bold text-primary capitalize">{{ $formRequest !== 'view' ? ($formRequest === 'update' ? __("messages.dashboard.web.service.form.headers.update") : __("messages.dashboard.web.service.form.headers.create")) : __("messages.dashboard.web.service.form.headers.view")  }}</h5>

    <form id="service-form"
      action="{{ $formRequest === 'create' ? route('services.store') : ($formRequest === 'update' ? route('services.update', $service->id) : '#') }}" enctype="multipart/form-data"
      method="POST">
        @csrf <!-- Include CSRF token for security -->

        @if($formRequest === 'update')
            @method('PUT') <!-- Specify PUT method for updating -->
        @endif
        <!-- Name Field -->
        <div class="mb-4 mt-4">
            <label for="name" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.name") }}</label>
            <input type="text" id="name" name="name" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('name', $service->name ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.name") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-name"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="icon" class="block text-sm font-bold text-secondary-dark capitalize">
                {{ __("messages.dashboard.web.service.form.fields.icon") }}
            </label>

            <div class="w-full h-auto flex flex-row gap-x-4">
                <select id="icon" name="icon" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" {{ $formRequest === "view" ? "disabled" : "" }}>
                    <option value="" disabled selected>{{ __("messages.dashboard.web.service.form.placeholders.icon") }}</option>

                    @foreach($icons as $filename => $content)
                        <option value="{{ $content }}" {{ old('icon', $service->icon ?? '') === $content ? 'selected' : '' }}>
                            {{ $filename }}
                        </option>
                    @endforeach
                </select>
                <img id="icon-image" src="/storage/images/svgs/ambulance.svg" class="h-12 w-12 shadow-md rounded-xl p-2 border-2 border-primary text-primary"/>
            </div>

            <span  class="text-primary font-bold text-xs error-message" id="error-icon"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="short_description" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.short_description") }}</label>
            <textarea id="short_description" name="short_description" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.short_description") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old('short_description', $service->short_description ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-short_description"></span>
        </div>

        <label class="text-lg text-primary font-bold">{{ __("messages.dashboard.web.service.form.fields.webcontent") }}</label>

        <div class="mb-4 mt-4">
            <label for="webcontent[header]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_header") }}</label>
            <input type="text" id="webcontent[header]" name="webcontent[header]" class="mt-2 text-sm block  w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.header", $service->webcontent['header'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_header") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.header"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[title]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_title") }}</label>
            <input type="text" id="webcontent[title]" name="webcontent[title]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.title", $service->webcontent['title'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_title") }}" {{$formRequest === "view" ? "disabled" : ""}}>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.title"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[description]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_description") }}</label>
            <textarea id="webcontent[description]" name="webcontent[description]" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_description") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old("webcontent.description", $service->webcontent['description'] ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.description"></span>
        </div>


        <div class="mb-4 mt-4">
            <label for="webcontent[image]" class="block text-sm font-bold text-secondary-dark capitalize mb-4">{{ __("messages.dashboard.web.service.form.fields.webcontent_image") }}</label>
            <div class="flex flex-row justify-start gap-x-2">
                <div id="image-viewer-webcontent-image" class="h-[150px] w-[150px] border-2 border-gray-light rounded-xl bg-contain bg-no-repeat bg-center" style="background-image:url({{ $service ? asset('storage/' . $service->webcontent['image']) : '' }})">

                </div>
                <div class="file-select" id="src-tent-image" >
                  <input type="file" name="webcontent[image]" aria-label="webcontent[image]" onchange="previewImage(event, 'webcontent-image')" {{$formRequest === "view" ? "disabled" : ""}}/>
                </div>
            </div>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.image"></span>
        </div>



        <p class="text-lg text-primary font-bold mt-4">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview") }}</p>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][header]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_header") }}</label>
            <input id="webcontent[overview][header]" type="text" name="webcontent[overview][header]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.overview.header", $service->webcontent['overview']['header'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_overview_header") }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.header"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][title]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_title") }}</label>
            <input id="webcontent[overview][title]" type="text" name="webcontent[overview][title]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_overview_title") }}" value="{{ old("webcontent.overview.title", $service->webcontent['overview']['title'] ?? '') }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.title"></span>
        </div>

        @php
            $sceneCatalog = [
                'scene:route'      => 'Ruta Operativa · Flujo Integral (Blueprint)',
                'scene:walkers'    => 'Equipo en Almacén & Courier (Personas con paquetes)',
                'scene:plane'      => 'Despegue de Carga Aérea Internacional (Avión)',
                'scene:ship'       => 'Buque Portacontenedores · Zarpe Marítimo (Barco)',
                'scene:truck'      => 'Transporte Terrestre · Puerta a Puerta (Camión LanEx)',
                'scene:customs'    => 'Gestión Aduanera SUNAT · Escáner y DAM (Aduanas)',
                'scene:consulting' => 'Planeamiento de Comercio Exterior (Asesoría)',
            ];

            // Discover any custom uploaded SVGs in storage/app/public/images/service
            $customUploadedSvgs = [];
            $serviceStorageDir = storage_path('app/public/images/service');
            if (is_dir($serviceStorageDir)) {
                foreach ( glob($serviceStorageDir . '/*.{svg,png,jpg,jpeg,webp,gif}', GLOB_BRACE) ?: [] as $filePath ) {
                    $rel = '/images/service/' . basename($filePath);
                    $customUploadedSvgs[$rel] = 'Archivo subido: ' . basename($filePath);
                }
            }

            $rawOverviewImage = trim($service->webcontent['overview']['image'] ?? '');
            if (empty($rawOverviewImage) || str_starts_with($rawOverviewImage, '/images/web/')) {
                $ovText = mb_strtolower(($service->webcontent['overview']['header'] ?? '') . ' ' . ($service->webcontent['overview']['title'] ?? '') . ' ' . ($service->webcontent['overview']['content']['introduction'] ?? ''));
                if (str_contains($ovText, 'asesoría especializada')) {
                    $currentOverviewScene = 'scene:route';
                } elseif (str_contains($ovText, 'coordinación integral') || str_contains($ovText, 'puerta a puerta')) {
                    $currentOverviewScene = 'scene:truck';
                } elseif (str_contains($ovText, 'aduan')) {
                    $currentOverviewScene = 'scene:ship';
                } elseif (str_contains($ovText, 'marítimo') || str_contains($ovText, 'aéreo') || str_contains($ovText, 'usa')) {
                    $currentOverviewScene = 'scene:plane';
                } else {
                    $currentOverviewScene = 'scene:walkers';
                }
            } else {
                $currentOverviewScene = $rawOverviewImage;
            }
            $isOverviewCustom = !array_key_exists($currentOverviewScene, $sceneCatalog);

            $rawContentLinkImage = trim($service->webcontent['content_link']['image'] ?? '');
            if (empty($rawContentLinkImage) || str_starts_with($rawContentLinkImage, '/images/web/')) {
                $clText = mb_strtolower(($service->webcontent['content_link']['header'] ?? '') . ' ' . ($service->webcontent['content_link']['title'] ?? '') . ' ' . ($service->webcontent['content_link']['content'] ?? ''));
                if (str_contains($clText, 'sunat') || str_contains($clText, 'representación aduanera')) {
                    $currentContentLinkScene = 'scene:customs';
                } elseif (str_contains($clText, 'consultas de comercio exterior') || str_contains($clText, 'dudas sobre importación')) {
                    $currentContentLinkScene = 'scene:consulting';
                } elseif (str_contains($clText, 'marítim') || str_contains($clText, 'fcl') || str_contains($clText, 'breakbulk') || str_contains($clText, 'multimodal')) {
                    $currentContentLinkScene = 'scene:ship';
                } elseif (str_contains($clText, 'distribu') || str_contains($clText, 'truck')) {
                    $currentContentLinkScene = 'scene:truck';
                } else {
                    $currentContentLinkScene = 'scene:walkers';
                }
            } else {
                $currentContentLinkScene = $rawContentLinkImage;
            }
            $isContentLinkCustom = !array_key_exists($currentContentLinkScene, $sceneCatalog);
        @endphp

        <div class="mb-6 mt-5 p-4 rounded-2xl bg-slate-50 border border-slate-200/90">
            <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                <div>
                    <label for="webcontent-overview-scene" class="block text-sm font-bold text-slate-900 capitalize">
                        {{ __("messages.dashboard.web.service.form.fields.webcontent_overview_image") }} (SVG en Página)
                    </label>
                    <p class="text-xs text-slate-500">Visualiza el SVG animado actual de la sección o agrega otro archivo SVG / código SVG.</p>
                </div>
                <span id="badge-svg-overview" class="text-[11px] font-mono font-semibold px-2.5 py-1 rounded-lg bg-purple-100 text-primary border border-purple-200">
                    {{ $sceneCatalog[$currentOverviewScene] ?? ('Personalizado: ' . basename($currentOverviewScene)) }}
                </span>
            </div>

            <!-- Vista Previa en Vivo del SVG que está en la página -->
            <div id="svg-live-stage-overview" class="w-full mb-4 rounded-xl overflow-hidden bg-white border border-slate-200 p-2 shadow-2xs">
                @foreach($sceneCatalog as $sceneKey => $sceneLabel)
                    <div data-scene-item="{{ $sceneKey }}" class="{{ $currentOverviewScene === $sceneKey ? 'block' : 'hidden' }}">
                        <x-animated-logistics-scene :scene="$sceneKey" :title="$service->webcontent['overview']['title'] ?? 'Vista previa'" />
                    </div>
                @endforeach
                <div data-scene-item="custom" class="{{ $isOverviewCustom ? 'block' : 'hidden' }}">
                    <div id="svg-custom-holder-overview" class="w-full min-h-[220px] flex items-center justify-center bg-slate-50 rounded-xl border border-slate-200/80 p-4 [&>svg]:w-full [&>svg]:h-auto [&>svg]:max-h-[300px]">
                        @if($isOverviewCustom && !empty($currentOverviewScene))
                            <x-animated-logistics-scene :scene="$currentOverviewScene" :title="$service->webcontent['overview']['title'] ?? 'SVG Personalizado'" />
                        @else
                            <span class="text-xs text-slate-400 font-mono">Sube un archivo .svg o pega código &lt;svg&gt; para previsualizarlo aquí</span>
                        @endif
                    </div>
                </div>
            </div>

            @if($formRequest !== "view")
                <div class="grid grid-cols-1 gap-3">
                    <!-- 1. Selector de SVGs de la página o subidos -->
                    <div>
                        <label for="webcontent-overview-scene" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                            1. Seleccionar animación SVG de la página
                        </label>
                        <select
                            id="webcontent-overview-scene"
                            name="webcontent[overview][scene]"
                            onchange="selectServiceSvgScene('overview', this.value)"
                            class="text-sm block w-full h-10 px-3 rounded-xl border border-slate-300 bg-white focus:border-primary focus:outline-none text-slate-800 font-medium"
                        >
                            <optgroup label="Animaciones SVG Interactivas de la Web">
                                @foreach($sceneCatalog as $sceneKey => $sceneLabel)
                                    <option value="{{ $sceneKey }}" {{ $currentOverviewScene === $sceneKey ? 'selected' : '' }}>
                                        {{ $sceneLabel }}
                                    </option>
                                @endforeach
                            </optgroup>
                            @if(count($customUploadedSvgs) > 0 || $isOverviewCustom)
                                <optgroup label="SVGs / Imágenes Subidas">
                                    @if($isOverviewCustom && !isset($customUploadedSvgs[$currentOverviewScene]))
                                        <option value="{{ $currentOverviewScene }}" selected>
                                            Actual: {{ basename($currentOverviewScene) }}
                                        </option>
                                    @endif
                                    @foreach($customUploadedSvgs as $customPath => $customLabel)
                                        <option value="{{ $customPath }}" {{ $currentOverviewScene === $customPath ? 'selected' : '' }}>
                                            {{ $customLabel }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endif
                        </select>
                    </div>

                    <!-- 2. Subir un nuevo archivo .SVG o imagen o pegar código SVG -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-2.5 pt-2 border-t border-slate-200/80">
                        <div class="flex items-center gap-2.5">
                            <div class="file-select" id="src-tent-image">
                                <input
                                    type="file"
                                    id="webcontent-overview-file"
                                    name="webcontent[overview][image]"
                                    accept=".svg,image/svg+xml,image/png,image/jpeg,image/webp,image/gif"
                                    aria-label="Subir SVG o Imagen"
                                    onchange="previewServiceSvgUpload(event, 'overview')"
                                />
                            </div>
                            <span id="file-name-overview" class="text-xs text-slate-500 truncate max-w-[180px]">Formatos: .svg, .png, .jpg, .webp</span>
                        </div>

                        <button
                            type="button"
                            onclick="toggleServiceSvgCodeBox('overview')"
                            class="h-9 px-3.5 rounded-xl border border-slate-300 hover:border-primary bg-white text-slate-700 hover:text-primary text-xs font-semibold inline-flex items-center justify-center gap-1.5 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                            <span>Pegar código &lt;svg&gt;</span>
                        </button>
                    </div>

                    <!-- 3. Cuadro opcional para pegar código <svg> directo -->
                    <div id="svg-code-box-overview" class="hidden pt-2">
                        <label for="webcontent-overview-svg-code" class="block text-xs font-bold text-slate-700 mb-1">
                            Código SVG directo (pega aquí tu etiqueta <code class="text-primary">&lt;svg ...&gt;...&lt;/svg&gt;</code>)
                        </label>
                        <textarea
                            id="webcontent-overview-svg-code"
                            name="webcontent[overview][svg_code]"
                            rows="4"
                            oninput="previewServiceSvgCode('overview', this.value)"
                            placeholder="<svg viewBox=&quot;0 0 500 340&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;>...</svg>"
                            class="w-full p-3 rounded-xl border border-slate-300 bg-slate-900 text-emerald-300 font-mono text-xs focus:border-primary focus:outline-none"
                        ></textarea>
                    </div>
                </div>
            @endif
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.image"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][content][header]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_content_header") }}</label>
            <textarea id="webcontent[overview][content][header]" name="webcontent[overview][content][header]" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"  placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_overview_content_header") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old("webcontent.overview.content.header", $service->webcontent['overview']['content']['header'] ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.content.header"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][content][introduction]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_content_introduction") }}</label>
            <textarea id="webcontent[overview][content][introduction]" name="webcontent[overview][content][introduction]" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"  placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_overview_content_introduction") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old("webcontent.overview.content.introduction", $service->webcontent['overview']['content']['introduction'] ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.content.introduction"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[overview][content][content]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_overview_content_content") }}</label>
            <textarea id="webcontent[overview][content][content]" name="webcontent[overview][content][content]" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"  placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_overview_content_content") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old("webcontent.overview.content.content", $service->webcontent['overview']['content']['content'] ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.overview.content.content"></span>
        </div>

        <p class="text-lg text-primary font-bold">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link") }}</p>

        <div class="mb-4 mt-4">
            <label for="webcontent[content_link][header]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link_header") }}</label>
            <input id="webcontent[content_link][header]" type="text" name="webcontent[content_link][header]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.content_link.header", $service->webcontent['content_link']['header'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_content_link_header") }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.content_link.header"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[content_link][title]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link_title") }}</label>
            <input id="webcontent[content_link][title]" type="text" name="webcontent[content_link][title]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_content_link_title") }}" value="{{ old("webcontent.content_link.title", $service->webcontent['content_link']['title'] ?? '') }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.content_link.title"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[content_link][button_label]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link_button_label") }}</label>
            <input id="webcontent[content_link][button_label]" type="text" name="webcontent[content_link][button_label]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_content_link_button_label") }}" value="{{ old("webcontent.content_link.button_label", $service->webcontent['content_link']['button_label'] ?? '') }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.content_link.button_label"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[content_link][content]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_content_link_content") }}</label>
            <textarea id="webcontent[content_link][content]" name="webcontent[content_link][content]" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body"  placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_content_link_content") }}" {{$formRequest === "view" ? "disabled" : ""}}>{{ old("webcontent.content_link.content", $service->webcontent['content_link']['content'] ?? '') }}</textarea>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.content_link.content"></span>
        </div>

        <div class="mb-6 mt-5 p-4 rounded-2xl bg-slate-50 border border-slate-200/90">
            <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                <div>
                    <label for="webcontent-content_link-scene" class="block text-sm font-bold text-slate-900 capitalize">
                        {{ __("messages.dashboard.web.service.form.fields.webcontent_content_link_image") }} (SVG en Página)
                    </label>
                    <p class="text-xs text-slate-500">Visualiza el SVG animado actual de la sección o agrega otro archivo SVG / código SVG.</p>
                </div>
                <span id="badge-svg-content_link" class="text-[11px] font-mono font-semibold px-2.5 py-1 rounded-lg bg-purple-100 text-primary border border-purple-200">
                    {{ $sceneCatalog[$currentContentLinkScene] ?? ('Personalizado: ' . basename($currentContentLinkScene)) }}
                </span>
            </div>

            <!-- Vista Previa en Vivo del SVG que está en la página -->
            <div id="svg-live-stage-content_link" class="w-full mb-4 rounded-xl overflow-hidden bg-white border border-slate-200 p-2 shadow-2xs">
                @foreach($sceneCatalog as $sceneKey => $sceneLabel)
                    <div data-scene-item="{{ $sceneKey }}" class="{{ $currentContentLinkScene === $sceneKey ? 'block' : 'hidden' }}">
                        <x-animated-logistics-scene :scene="$sceneKey" :title="$service->webcontent['content_link']['title'] ?? 'Vista previa'" />
                    </div>
                @endforeach
                <div data-scene-item="custom" class="{{ $isContentLinkCustom ? 'block' : 'hidden' }}">
                    <div id="svg-custom-holder-content_link" class="w-full min-h-[220px] flex items-center justify-center bg-slate-50 rounded-xl border border-slate-200/80 p-4 [&>svg]:w-full [&>svg]:h-auto [&>svg]:max-h-[300px]">
                        @if($isContentLinkCustom && !empty($currentContentLinkScene))
                            <x-animated-logistics-scene :scene="$currentContentLinkScene" :title="$service->webcontent['content_link']['title'] ?? 'SVG Personalizado'" />
                        @else
                            <span class="text-xs text-slate-400 font-mono">Sube un archivo .svg o pega código &lt;svg&gt; para previsualizarlo aquí</span>
                        @endif
                    </div>
                </div>
            </div>

            @if($formRequest !== "view")
                <div class="grid grid-cols-1 gap-3">
                    <!-- 1. Selector de SVGs de la página o subidos -->
                    <div>
                        <label for="webcontent-content_link-scene" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                            1. Seleccionar animación SVG de la página
                        </label>
                        <select
                            id="webcontent-content_link-scene"
                            name="webcontent[content_link][scene]"
                            onchange="selectServiceSvgScene('content_link', this.value)"
                            class="text-sm block w-full h-10 px-3 rounded-xl border border-slate-300 bg-white focus:border-primary focus:outline-none text-slate-800 font-medium"
                        >
                            <optgroup label="Animaciones SVG Interactivas de la Web">
                                @foreach($sceneCatalog as $sceneKey => $sceneLabel)
                                    <option value="{{ $sceneKey }}" {{ $currentContentLinkScene === $sceneKey ? 'selected' : '' }}>
                                        {{ $sceneLabel }}
                                    </option>
                                @endforeach
                            </optgroup>
                            @if(count($customUploadedSvgs) > 0 || $isContentLinkCustom)
                                <optgroup label="SVGs / Imágenes Subidas">
                                    @if($isContentLinkCustom && !isset($customUploadedSvgs[$currentContentLinkScene]))
                                        <option value="{{ $currentContentLinkScene }}" selected>
                                            Actual: {{ basename($currentContentLinkScene) }}
                                        </option>
                                    @endif
                                    @foreach($customUploadedSvgs as $customPath => $customLabel)
                                        <option value="{{ $customPath }}" {{ $currentContentLinkScene === $customPath ? 'selected' : '' }}>
                                            {{ $customLabel }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endif
                        </select>
                    </div>

                    <!-- 2. Subir un nuevo archivo .SVG o imagen o pegar código SVG -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-2.5 pt-2 border-t border-slate-200/80">
                        <div class="flex items-center gap-2.5">
                            <div class="file-select" id="src-tent-image">
                                <input
                                    type="file"
                                    id="webcontent-content_link-file"
                                    name="webcontent[content_link][image]"
                                    accept=".svg,image/svg+xml,image/png,image/jpeg,image/webp,image/gif"
                                    aria-label="Subir SVG o Imagen"
                                    onchange="previewServiceSvgUpload(event, 'content_link')"
                                />
                            </div>
                            <span id="file-name-content_link" class="text-xs text-slate-500 truncate max-w-[180px]">Formatos: .svg, .png, .jpg, .webp</span>
                        </div>

                        <button
                            type="button"
                            onclick="toggleServiceSvgCodeBox('content_link')"
                            class="h-9 px-3.5 rounded-xl border border-slate-300 hover:border-primary bg-white text-slate-700 hover:text-primary text-xs font-semibold inline-flex items-center justify-center gap-1.5 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                            <span>Pegar código &lt;svg&gt;</span>
                        </button>
                    </div>

                    <!-- 3. Cuadro opcional para pegar código <svg> directo -->
                    <div id="svg-code-box-content_link" class="hidden pt-2">
                        <label for="webcontent-content_link-svg-code" class="block text-xs font-bold text-slate-700 mb-1">
                            Código SVG directo (pega aquí tu etiqueta <code class="text-primary">&lt;svg ...&gt;...&lt;/svg&gt;</code>)
                        </label>
                        <textarea
                            id="webcontent-content_link-svg-code"
                            name="webcontent[content_link][svg_code]"
                            rows="4"
                            oninput="previewServiceSvgCode('content_link', this.value)"
                            placeholder="<svg viewBox=&quot;0 0 500 340&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;>...</svg>"
                            class="w-full p-3 rounded-xl border border-slate-300 bg-slate-900 text-emerald-300 font-mono text-xs focus:border-primary focus:outline-none"
                        ></textarea>
                    </div>
                </div>
            @endif
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.content_link.image"></span>
        </div>


        <p class="text-lg text-primary font-bold mt-4">{{ __("messages.dashboard.web.service.form.fields.webcontent_keypoints_points") }}</p>

        <div class="mb-4 mt-4">
            <label for="webcontent[keypoints][header]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_keypoints_header") }}</label>
            <input id="webcontent[keypoints][header]" type="text" name="webcontent[keypoints][header]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old("webcontent.keypoints.header", $service->webcontent['keypoints']['header'] ?? '') }}" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_keypoints_header") }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.keypoints.header"></span>
        </div>

        <div class="mb-4 mt-4">
            <label for="webcontent[keypoints][title]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_keypoints_title") }}</label>
            <input id="webcontent[keypoints][title]" type="text" name="webcontent[keypoints][title]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_keypoints_title") }}" value="{{ old("webcontent.keypoints.title", $service->webcontent['keypoints']['title'] ?? '') }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.keypoints.title"></span>
        </div>

        <div class="my-4">
            <div class="w-full h-auto flex flex-row justify-between">
                <p class="text-sm text-primary font-bold">{{__('messages.dashboard.web.service.form.fields.webcontent_keypoints_points')}}</p>
                <button type="button" class="hover:bg-white hover:text-primary active:scale-95 duration-300 border-2 border-primary bg-primary text-white px-4 py-2 rounded-xl ml-auto disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-100"  onclick="addPoint()" {{$formRequest === 'view' ? 'disabled' : ''}}>{{__('messages.dashboard.web.service.form.fields.webcontent_keypoints_points_add')}}</button>
            </div>
            <!-- Container for dynamic points -->
            <div id="points-container" class="mb-4 mt-4">
                @if($service)
                    @foreach($service->webcontent['keypoints']['points'] as $index => $point)
                        <div class="point-item mb-4 mt-4 border-2 border-secondary-dark flex flex-col rounded-md p-4 animation-element in-view slide-in-up">
                            <div class="flex flex-row justify-between w-full h-auto">
                                <p class="text-sm font-bold text-primary capitalize">{{__('messages.dashboard.web.service.form.fields.webcontent_keypoints_point')}} {{ $index + 1 }}</p>
                                @if($formRequest !== 'view')
                                <button type="button" class="text-sm font-bold text-primary capitalize rounded-xl active:scale-95 duration-300 transition-all bg-secondary-dark hover:bg-primary px-4 py-2 text-white" onclick="this.closest('.point-item').remove(); updatePointTitles()">
                                    {{ __('messages.common.delete') }}
                                </button>
                                @endif
                            </div>

                            <label class="block text-sm font-bold text-secondary-dark capitalize mt-2">{{__('messages.dashboard.web.service.form.fields.webcontent_keypoints_points_point_title')}}</label>
                            <input type="text" name="webcontent[keypoints][points][{{ $index }}][title]" value="{{ $point['title'] }}" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{__('messages.dashboard.web.service.form.placeholders.webcontent_keypoints_points_title')}}">

                            <label class="block text-sm font-bold text-secondary-dark capitalize mt-2">{{__('messages.dashboard.web.service.form.fields.webcontent_keypoints_points_point_content')}}</label>
                            <textarea name="webcontent[keypoints][points][{{ $index }}][content]" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{__('messages.dashboard.web.service.form.placeholders.webcontent_keypoints_points_content')}}">{{ $point['content'] }}</textarea>
                        </div>
                    @endforeach
                @endif
            </div>

            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.keypoints.points"></span>
        </div>

        <p class="text-lg text-primary font-bold">{{__('messages.dashboard.web.service.form.fields.webcontent_faqs')}}</p>

        <div class="mb-4 mt-4">
            <label for="webcontent[faqs][title]" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_faqs_title") }}</label>
            <input id="webcontent[faqs][title]" type="text" name="webcontent[faqs][title]" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_faqs_title") }}" value="{{ old("webcontent.faqs.title", $service->webcontent['faqs']['title'] ?? '') }}" {{$formRequest === "view" ? "disabled" : ""}}/>
            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.faqs.title"></span>
        </div>

        <div class="my-4">
            <div class="w-full h-auto flex flex-row justify-between">
                <p class="text-sm text-primary font-bold">{{ __("messages.dashboard.web.service.form.fields.webcontent_faqs_questions") }}</p>
                <button type="button" class="hover:bg-white hover:text-primary active:scale-95 duration-300 border-2 border-primary bg-primary text-white px-4 py-2 rounded-xl ml-auto disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-100" onclick="addQuestion('webcontent[faqs]')" {{ $formRequest === 'view' ? 'disabled' :'' }}>{{ __("messages.dashboard.web.service.form.fields.webcontent_faqs_questions_add") }}</button>
            </div>
            <!-- Container for dynamic points -->
            <div id="questions-container" class="mb-4 mt-4">

                @if($service)
                    <!-- Iterate over the existing questions -->
                    @foreach($service->webcontent['faqs']['questions'] as $index => $question)
                        <div class="question-item mb-4 mt-4 border-2 border-secondary-dark flex flex-col rounded-md p-4 animation-element in-view slide-in-up">
                            <div class="flex flex-row justify-between w-full h-auto">
                                <p class="text-sm font-bold text-primary capitalize">{{ __("messages.dashboard.web.service.form.fields.webcontent_faqs_question") }} {{ $index + 1 }}</p>

                                @if($formRequest !== 'view')
                                <button type="button" class="text-sm font-bold text-primary capitalize rounded-xl active:scale-95 duration-300 transition-all bg-secondary-dark hover:bg-primary px-4 py-2 text-white" onclick="this.closest('.question-item').remove(); updateQuestionTitles('webcontent[faqs][questions]')">
                                    {{ __('messages.common.delete') }}
                                </button>
                                @endif
                            </div>

                            <label class="block text-sm font-bold text-secondary-dark capitalize mt-2">{{ __("messages.dashboard.web.service.form.fields.webcontent_faqs_question_question") }}</label>
                            <input type="text" name="webcontent[faqs][questions][{{ $index }}][question]" value="{{ $question['question'] }}" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_faqs_question") }}">

                            <label class="block text-sm font-bold text-secondary-dark capitalize mt-2">{{ __("messages.dashboard.web.service.form.fields.webcontent_faqs_question_answer") }}</label>
                            <textarea name="webcontent[faqs][questions][{{ $index }}][answer]" class="no-scroll-bar mt-2 text-sm block !h-[150px] w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.service.form.placeholders.webcontent_faqs_answer") }}">{{ $question['answer'] }}</textarea>
                        </div>
                    @endforeach
                @endif
            </div>

            <span class="text-primary font-bold text-xs error-message" id="error-webcontent.faqs.questions"></span>
        </div>

        <!-- Suppliers -->
        <div class="mb-4 mt-4">
            <div class="w-full h-auto flex flex-col justify-start">
                <p class="text-sm text-primary font-bold capitalize">{{ __("messages.dashboard.web.product.form.fields.suppliers") }}</p>
                <div class="w-full h-auto flex flex-row gap-x-4">
                    <select name="suppliers_options" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body">
                        <option>{{ __("messages.common.no_suppliers_options") }}</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="hover:bg-white hover:text-primary active:scale-95 duration-300 border-2 border-primary bg-primary text-white px-4 py-2 rounded-xl ml-auto disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-100 w-[30%]" onclick="addEntity('supplier','{{__('messages.dashboard.web.supplier.name')}}')" {{ $formRequest === 'view' ? 'disabled' :'' }}>{{ __("messages.dashboard.web.product.form.fields.add_supplier") }}</button>
                </div>
            </div>
            <!-- Container for dynamic points -->
            <div id="suppliers-container" class="mb-4 mt-4">
                @if($service && $service->suppliers)
                    @foreach($service->suppliers as $index => $supplier)
                        <div class="supplier-item mb-4 mt-4 border-2 border-secondary-dark flex flex-col rounded-md p-4 animation-element in-view slide-in-up">
                            <div class="flex flex-row justify-between w-full h-auto">
                                <p class="text-sm font-bold text-primary capitalize">{{ __("messages.dashboard.web.product.form.fields.supplier") }} {{ $supplier->id }}</p>

                                @if($formRequest !== 'view')
                                <button type="button" class="text-sm font-bold text-primary capitalize rounded-xl active:scale-95 duration-300 transition-all bg-secondary-dark hover:bg-primary px-4 py-2 text-white" onclick="this.closest('.supplier-item').remove(); updateEntityIndex('supplier');">
                                    {{ __('messages.common.delete') }}
                                </button>
                                @endif
                            </div>
                            <input type="text" value="{{ $supplier->name }}" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.web.product.form.placeholders.suppliers") }}" disabled>
                            <input type="hidden" name="suppliers[{{ $index }}]" value="{{$supplier->id}}">
                        </div>
                    @endforeach
                @endif
            </div>
            <span class="text-primary font-bold text-xs error-message" id="error-suppliers"></span>
        </div>




        <!-- Submit Button -->
        <div class="flex {{ $formRequest == "view" ? 'justify-end' : 'justify-between' }} ">
            <button type="button" onclick="clearContent()" class="clear_content_form_button px-4 py-2 bg-secondary-dark text-white duration-300 hover:bg-primary rounded-md active:scale-95 capitalize">
                <p>
                    {{ __('messages.dashboard.web.service.form.buttons.cancel') }}
                </p>
            </button>
            @if($formRequest != 'view')
                <button  type="submit"  class="px-4 py-2 bg-primary text-white duration-300 hover:bg-primary-dark rounded-md active:scale-95 capitalize">
                    {{ $formRequest == "update" ? __('messages.dashboard.web.service.form.buttons.update') : __('messages.dashboard.web.service.form.buttons.create') }}
                </button>
            @endif
        </div>
    </form>
</div>

<script>

</script>
