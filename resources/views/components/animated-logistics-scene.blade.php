@php
    $rawScene = trim($scene ?? 'walkers');
    $scene = str_starts_with($rawScene, 'scene:') ? substr($rawScene, 6) : $rawScene;
    $isCustomAsset = str_starts_with($scene, '/') || str_starts_with($scene, 'http') || preg_match('/\.(svg|png|jpe?g|webp|gif)$/i', $scene);
@endphp

<div class="js-friendly-svg-scene relative w-full rounded-2xl {{ $scene === 'route' ? 'bg-slate-950 border-slate-800 text-white shadow-xl' : 'bg-slate-50 border-slate-200/90 shadow-xs' }} border p-4 sm:p-6 overflow-hidden select-none" data-scene="{{ $scene }}">
    <style>
        @keyframes svgWalkLegA {
            0%, 100% { transform: rotate(-16deg); }
            50% { transform: rotate(16deg); }
        }
        @keyframes svgWalkLegB {
            0%, 100% { transform: rotate(16deg); }
            50% { transform: rotate(-16deg); }
        }
        @keyframes svgBodyBob {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-3.5px); }
        }
        @keyframes svgCloudDriftSlow {
            0%, 100% { transform: translateX(0px); }
            50% { transform: translateX(-18px); }
        }
        @keyframes svgPlaneHover {
            0%, 100% { transform: translateY(0px) rotate(-12deg); }
            50% { transform: translateY(-6px) rotate(-14deg); }
        }
        @keyframes svgShipRock {
            0%, 100% { transform: translateY(0px) rotate(-1deg); }
            50% { transform: translateY(-4px) rotate(1deg); }
        }
        @keyframes svgWaveSlideA {
            0%, 100% { transform: translateX(0px); }
            50% { transform: translateX(-14px); }
        }
        @keyframes svgWaveSlideB {
            0%, 100% { transform: translateX(0px); }
            50% { transform: translateX(14px); }
        }
        @keyframes svgWheelRotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        @keyframes svgScanPulse {
            0%, 100% { opacity: 0.25; transform: scaleY(0.92); }
            50% { opacity: 0.65; transform: scaleY(1.04); }
        }
        .svg-leg-a {
            transform-origin: 0px 0px;
            animation: svgWalkLegA 0.8s ease-in-out infinite;
        }
        .svg-leg-b {
            transform-origin: 0px 0px;
            animation: svgWalkLegB 0.8s ease-in-out infinite;
        }
        .svg-body-bob {
            animation: svgBodyBob 0.4s ease-in-out infinite;
        }
        .svg-cloud-drift {
            animation: svgCloudDriftSlow 6s ease-in-out infinite;
        }
        .svg-plane-float {
            transform-origin: 110px 35px;
            animation: svgPlaneHover 2.6s ease-in-out infinite;
        }
        .svg-ship-rock {
            transform-origin: 140px 110px;
            animation: svgShipRock 3.2s ease-in-out infinite;
        }
        .svg-wave-a {
            animation: svgWaveSlideA 3.5s ease-in-out infinite;
        }
        .svg-wave-b {
            animation: svgWaveSlideB 4.2s ease-in-out infinite;
        }
        .svg-wheel-spin {
            transform-origin: 0px 0px;
            animation: svgWheelRotate 1.8s linear infinite;
        }
        .svg-scan-beam {
            transform-origin: center top;
            animation: svgScanPulse 2s ease-in-out infinite;
        }
        .js-scroll-actor {
            transition: transform 120ms ease-out;
            will-change: transform;
        }
    </style>

    @if($scene === 'walkers')
        <!-- SCENE 1: Personas caminando llevando paquetes (Anatomically connected shoulders/arms/legs) -->
        <svg class="w-full h-auto block" viewBox="0 0 500 340" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Equipo logístico trasladando paquetes">
            <!-- Background Card -->
            <path d="M 28 15 H 472 A 18 18 0 0 1 490 33 V 307 A 18 18 0 0 1 472 325 H 28 A 18 18 0 0 1 10 307 V 33 A 18 18 0 0 1 28 15 Z" fill="#F8FAFC" />

            <!-- Warehouse Storage Shelving Left -->
            <g opacity="0.6">
                <path d="M 35 55 H 125 V 265 H 35 Z" stroke="#CBD5E1" stroke-width="2.5" />
                <path d="M 35 120 H 125 M 35 185 H 125" stroke="#CBD5E1" stroke-width="2.5" />
                <path d="M 45 86 H 76 V 118 H 45 Z" fill="#E2E8F0" />
                <path d="M 82 94 H 114 V 118 H 82 Z" fill="#DDD6FE" />
                <path d="M 45 150 H 84 V 183 H 45 Z" fill="#DDD6FE" />
                <path d="M 90 156 H 115 V 183 H 90 Z" fill="#E2E8F0" />
            </g>

            <!-- Dispatch Zone Bay Right -->
            <g transform="translate(382, 82)">
                <path d="M 8 0 H 82 A 8 8 0 0 1 90 8 V 184 H 0 V 8 A 8 8 0 0 1 8 0 Z" fill="#EDE9FE" stroke="#C4B5FD" stroke-width="2" />
                <path d="M 12 14 H 78 V 34 H 12 Z" fill="#6D28D9" />
                <text x="45" y="27.5" text-anchor="middle" fill="#FFFFFF" font-size="8.5" font-weight="700" font-family="sans-serif">DESPACHO</text>
                <path d="M 18 134 H 72 V 184 H 18 Z" fill="#DDD6FE" />
            </g>

            <!-- Floor Line -->
            <path d="M 20 266 H 480" stroke="#CBD5E1" stroke-width="3" stroke-linecap="round" />
            <path d="M 45 280 H 455" stroke="#E2E8F0" stroke-width="2" stroke-dasharray="8 8" stroke-linecap="round" />

            <!-- Scroll-Moved Group: Two Operators Walking with Packages -->
            <g class="js-scroll-actor" data-move-x="48" data-move-y="0">
                <!-- OPERATOR 1: Walking & Carrying Parcel Stack in Both Hands -->
                <g transform="translate(95, 98)">
                    <!-- Back Leg (Hip pivot at 26, 108) -->
                    <g transform="translate(26, 108)">
                        <g class="svg-leg-b">
                            <path d="M 0 0 L -6 52" stroke="#1E293B" stroke-width="11" stroke-linecap="round" />
                            <path d="M -12 50 H 8 A 4 4 0 0 1 12 54 V 58 H -12 Z" fill="#475569" />
                        </g>
                    </g>
                    <!-- Front Leg (Hip pivot at 38, 108) -->
                    <g transform="translate(38, 108)">
                        <g class="svg-leg-a">
                            <path d="M 0 0 L 6 52" stroke="#0F172A" stroke-width="11" stroke-linecap="round" />
                            <path d="M 0 50 H 20 A 4 4 0 0 1 24 54 V 58 H 0 Z" fill="#6D28D9" />
                        </g>
                    </g>

                    <!-- Upper Body + Arms + Carried Boxes (Single Unified Coordinate Space) -->
                    <g class="svg-body-bob">
                        <!-- Back Arm (Shoulder at 38,52 -> Hand under box at 78,70) -->
                        <path d="M 38 52 L 56 70 L 78 68" stroke="#4C1D95" stroke-width="9" stroke-linecap="round" stroke-linejoin="round" fill="none" />

                        <!-- Torso (x=16..50, y=42..110) -->
                        <path d="M 28 42 H 38 A 12 12 0 0 1 50 54 V 102 A 8 8 0 0 1 42 110 H 24 A 8 8 0 0 1 16 102 V 54 A 12 12 0 0 1 28 42 Z" fill="#6D28D9" />
                        <!-- Collar & Vest Strip -->
                        <path d="M 26 42 L 33 58 L 40 42 Z" fill="#EDE9FE" />
                        <path d="M 16 82 H 50 V 88 H 16 Z" fill="#A78BFA" />

                        <!-- Neck & Head (Centered at 33, 22) -->
                        <path d="M 28 32 H 38 V 44 H 28 Z" fill="#FDBA74" />
                        <path d="M 19 22 a 14 14 0 1 0 28 0 a 14 14 0 1 0 -28 0" fill="#FDBA74" />
                        <!-- Eye & Smile -->
                        <path d="M 38 20 a 1.8 1.8 0 1 0 3.6 0 a 1.8 1.8 0 1 0 -3.6 0" fill="#1E293B" />
                        <path d="M 35 26 Q 39 29 43 25.5" stroke="#1E293B" stroke-width="1.8" stroke-linecap="round" fill="none" />
                        <!-- LanEx Cap -->
                        <path d="M 18 18 C 18 6, 48 6, 48 18 Z" fill="#4C1D95" />
                        <path d="M 34 15 L 55 18 L 46 20 Z" fill="#6D28D9" />

                        <!-- Carried Boxes Held Against Chest (x=48..96, y=24..82) -->
                        <!-- Bottom Box -->
                        <path d="M 48 48 H 96 V 82 H 48 Z" fill="#F59E0B" stroke="#D97706" stroke-width="2" stroke-linejoin="round" />
                        <path d="M 68 48 H 76 V 60 H 68 Z" fill="#FEF3C7" />
                        <path d="M 55 68 H 70 V 74 H 55 Z" fill="#FFFFFF" opacity="0.9" />
                        <!-- Top Box -->
                        <path d="M 52 22 H 90 V 48 H 52 Z" fill="#FBBF24" stroke="#D97706" stroke-width="2" stroke-linejoin="round" />
                        <path d="M 67 22 H 75 V 32 H 67 Z" fill="#FEF3C7" />

                        <!-- Front Arm (Starts directly at Shoulder 26,54 -> Elbow 36,74 -> Hand holding box at 68,74) -->
                        <path d="M 26 54 L 36 74 L 68 74" stroke="#5B21B6" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                        <path d="M 64 74 a 5 5 0 1 0 10 0 a 5 5 0 1 0 -10 0" fill="#FDBA74" />
                    </g>
                </g>

                <!-- OPERATOR 2: Walking & Pushing Wheeled Platform Cart with Packages -->
                <g transform="translate(235, 104)">
                    <!-- Back Leg (Hip at 24, 102) -->
                    <g transform="translate(24, 102)">
                        <g class="svg-leg-a">
                            <path d="M 0 0 L -5 52" stroke="#334155" stroke-width="10" stroke-linecap="round" />
                            <path d="M -11 50 H 7 A 4 4 0 0 1 11 54 V 58 H -11 Z" fill="#1E293B" />
                        </g>
                    </g>
                    <!-- Front Leg (Hip at 34, 102) -->
                    <g transform="translate(34, 102)">
                        <g class="svg-leg-b">
                            <path d="M 0 0 L 6 52" stroke="#0F172A" stroke-width="10" stroke-linecap="round" />
                            <path d="M 0 50 H 18 A 4 4 0 0 1 22 54 V 58 H 0 Z" fill="#6D28D9" />
                        </g>
                    </g>

                    <!-- Upper Body + Arms holding Cart Handle at (56, 68) -->
                    <g class="svg-body-bob">
                        <!-- Torso (x=14..46, y=40..104) -->
                        <path d="M 24 40 H 36 A 10 10 0 0 1 46 50 V 96 A 8 8 0 0 1 38 104 H 22 A 8 8 0 0 1 14 96 V 50 A 10 10 0 0 1 24 40 Z" fill="#1E293B" />
                        <path d="M 18 46 H 42 V 92 H 18 Z" fill="#7C3AED" />
                        <!-- Neck & Head -->
                        <path d="M 26 30 H 34 V 42 H 26 Z" fill="#FDBA74" />
                        <path d="M 17 20 a 13 13 0 1 0 26 0 a 13 13 0 1 0 -26 0" fill="#FDBA74" />
                        <path d="M 34 18 a 1.7 1.7 0 1 0 3.4 0 a 1.7 1.7 0 1 0 -3.4 0" fill="#1E293B" />
                        <path d="M 32 24 Q 36 27 39 23.5" stroke="#1E293B" stroke-width="1.6" stroke-linecap="round" fill="none" />
                        <!-- Safety Helmet -->
                        <path d="M 16 17 C 16 5, 44 5, 44 17 Z" fill="#F59E0B" />
                        <path d="M 14 16 H 47 V 19 H 14 Z" fill="#D97706" />

                        <!-- Front Arm Connected from Shoulder (28, 52) -> Elbow (38, 66) -> Cart Handle (56, 66) -->
                        <path d="M 28 52 L 38 66 L 56 66" stroke="#1E293B" stroke-width="9.5" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                        <path d="M 52 66 a 4.5 4.5 0 1 0 9 0 a 4.5 4.5 0 1 0 -9 0" fill="#FDBA74" />
                    </g>

                    <!-- Platform Cart & Stacked Boxes -->
                    <g transform="translate(56, 56)">
                        <!-- Handlebar from (0, 10) down to deck (10, 86) and flat bed to (88, 86) -->
                        <path d="M 0 10 L 10 86 H 88" stroke="#475569" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                        <!-- Stacked Parcels on Cart -->
                        <path d="M 16 42 H 78 V 83 H 16 Z" fill="#F59E0B" stroke="#D97706" stroke-width="2" />
                        <path d="M 42 42 H 52 V 56 H 42 Z" fill="#FEF3C7" />
                        <path d="M 22 8 H 72 V 42 H 22 Z" fill="#EDE9FE" stroke="#8B5CF6" stroke-width="2" />
                        <path d="M 41 25 L 46 30 L 55 19" stroke="#6D28D9" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />

                        <!-- Rear Cart Wheel at (24, 94) -->
                        <g transform="translate(24, 94)">
                            <g class="svg-wheel-spin">
                                <path d="M -10 0 a 10 10 0 1 0 20 0 a 10 10 0 1 0 -20 0" fill="#1E293B" />
                                <path d="M -4 0 a 4 4 0 1 0 8 0 a 4 4 0 1 0 -8 0" fill="#E2E8F0" />
                                <path d="M -8 0 H 8 M 0 -8 V 8" stroke="#94A3B8" stroke-width="1.8" />
                            </g>
                        </g>
                        <!-- Front Cart Wheel at (74, 94) -->
                        <g transform="translate(74, 94)">
                            <g class="svg-wheel-spin">
                                <path d="M -10 0 a 10 10 0 1 0 20 0 a 10 10 0 1 0 -20 0" fill="#1E293B" />
                                <path d="M -4 0 a 4 4 0 1 0 8 0 a 4 4 0 1 0 -8 0" fill="#E2E8F0" />
                                <path d="M -8 0 H 8 M 0 -8 V 8" stroke="#94A3B8" stroke-width="1.8" />
                            </g>
                        </g>
                    </g>
                </g>
            </g>
        </svg>

    @elseif($scene === 'plane')
        <!-- SCENE 2: Avión Despegando (Cargo Airplane Taking Off on Scroll) -->
        <svg class="w-full h-auto block" viewBox="0 0 500 340" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Avión de carga LanEx despegando">
            <path d="M 28 15 H 472 A 18 18 0 0 1 490 33 V 307 A 18 18 0 0 1 472 325 H 28 A 18 18 0 0 1 10 307 V 33 A 18 18 0 0 1 28 15 Z" fill="#F8FAFC" />

            <!-- Drifting Clouds -->
            <g class="svg-cloud-drift" opacity="0.85">
                <path d="M 85 85 C 85 72, 104 68, 112 77 C 120 65, 142 68, 146 82 C 158 82, 162 96, 148 98 L 88 98 C 76 98, 75 85, 85 85 Z" fill="#EDE9FE" />
                <path d="M 335 65 C 335 52, 354 48, 362 57 C 370 45, 392 48, 396 62 C 408 62, 412 76, 398 78 L 338 78 C 326 78, 325 65, 335 65 Z" fill="#E2E8F0" />
                <path d="M 225 135 C 225 125, 240 122, 246 129 C 254 120, 270 122, 274 133 L 226 133 Z" fill="#F1F5F9" />
            </g>

            <!-- Airport Control Tower & Hangar Silhouette -->
            <g transform="translate(42, 148)" opacity="0.7">
                <path d="M 12 45 H 34 V 130 H 12 Z" fill="#CBD5E1" />
                <path d="M 4 45 L 42 45 L 36 22 L 10 22 Z" fill="#6D28D9" />
                <path d="M 10 27 H 36 V 39 H 10 Z" fill="#EDE9FE" />
                <path d="M 23 5 L 23 22" stroke="#64748B" stroke-width="2.5" />
                <path d="M 20 5 a 3 3 0 1 0 6 0 a 3 3 0 1 0 -6 0" fill="#8B5CF6" />
                <path d="M 44 88 H 119 V 130 H 44 Z" fill="#E2E8F0" />
            </g>

            <!-- Runway Strip at Bottom -->
            <path d="M 20 278 L 480 278 L 460 306 L 40 306 Z" fill="#1E293B" />
            <path d="M 55 292 L 445 292" stroke="#F8FAFC" stroke-width="3" stroke-dasharray="18 14" stroke-linecap="round" />

            <!-- Takeoff Trajectory Curve -->
            <path d="M 65 268 Q 220 245, 435 95" stroke="#DDD6FE" stroke-width="2.5" stroke-dasharray="6 6" fill="none" />

            <!-- Scroll-Driven Climbing Cargo Airplane -->
            <g class="js-scroll-actor" data-move-x="68" data-move-y="-52">
                <g transform="translate(115, 145)">
                    <g class="svg-plane-float">
                        <path d="M -45 32 L -10 32" stroke="#C4B5FD" stroke-width="2.5" stroke-linecap="round" />
                        <path d="M -32 44 L -4 44" stroke="#DDD6FE" stroke-width="2" stroke-linecap="round" />
                        <path d="M 8 28 L -14 -16 L 14 -12 L 36 24 Z" fill="#6D28D9" />
                        <path d="M 2 6 L -8 -10 L 8 -8 L 16 6 Z" fill="#A78BFA" />
                        <path d="M 75 26 L 42 -8 L 62 -10 L 105 24 Z" fill="#4C1D95" />
                        <path d="M 0 28 C 35 16, 145 14, 195 22 C 218 26, 228 36, 205 44 C 155 50, 45 48, 0 38 Z" fill="#FFFFFF" stroke="#CBD5E1" stroke-width="2" />
                        <path d="M 8 36 C 55 44, 155 44, 206 38 C 195 45, 140 48, 8 40 Z" fill="#6D28D9" />
                        <path d="M 186 24 L 204 28 L 200 33 L 182 31 Z" fill="#1E293B" />
                        <text x="82" y="34" fill="#4C1D95" font-size="12" font-weight="800" font-family="sans-serif">LanEx</text>
                        <path d="M 82 34 L 38 68 L 68 68 L 126 36 Z" fill="#7C3AED" />
                        <path d="M 84 48 H 100 A 6 6 0 0 1 106 54 A 6 6 0 0 1 100 60 H 84 A 6 6 0 0 1 78 54 A 6 6 0 0 1 84 48 Z" fill="#1E293B" />
                    </g>
                </g>
            </g>
        </svg>

    @elseif($scene === 'ship')
        <!-- SCENE 3: Barco Zarpando (Container Ship Sailing Out on Scroll) -->
        <svg class="w-full h-auto block" viewBox="0 0 500 340" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Barco portacontenedores LanEx zarpando">
            <path d="M 28 15 H 472 A 18 18 0 0 1 490 33 V 307 A 18 18 0 0 1 472 325 H 28 A 18 18 0 0 1 10 307 V 33 A 18 18 0 0 1 28 15 Z" fill="#F8FAFC" />

            <!-- Warm Horizon Sun & Clouds -->
            <path d="M 363 82 a 32 32 0 1 0 64 0 a 32 32 0 1 0 -64 0" fill="#FEF3C7" />
            <g class="svg-cloud-drift">
                <path d="M 95 72 C 95 60, 112 56, 120 65 C 128 55, 148 58, 152 70 L 95 70 Z" fill="#E2E8F0" />
                <path d="M 255 58 C 255 48, 270 45, 278 52 C 286 44, 302 46, 306 56 L 255 56 Z" fill="#EDE9FE" />
            </g>

            <!-- Port Crane Silhouette on Left Pier -->
            <g transform="translate(26, 92)" opacity="0.6">
                <path d="M 18 150 L 32 20 M 48 150 L 36 20" stroke="#94A3B8" stroke-width="4" />
                <path d="M 10 28 L 105 12" stroke="#64748B" stroke-width="4" stroke-linecap="round" />
                <path d="M 85 16 L 85 55" stroke="#94A3B8" stroke-width="2" stroke-dasharray="3 3" />
            </g>

            <!-- Back Ocean Wave Layer -->
            <g class="svg-wave-b">
                <path d="M -20 245 Q 35 232, 90 245 T 200 245 T 310 245 T 420 245 T 530 245 L 530 315 L -20 315 Z" fill="#DDD6FE" opacity="0.6" />
            </g>

            <!-- Scroll-Driven Sailing Container Ship -->
            <g class="js-scroll-actor" data-move-x="62" data-move-y="0">
                <g transform="translate(88, 112)">
                    <g class="svg-ship-rock">
                        <path d="M 24 28 H 68 V 86 H 24 Z" fill="#FFFFFF" stroke="#CBD5E1" stroke-width="2" />
                        <path d="M 18 16 H 74 V 32 H 18 Z" fill="#F8FAFC" stroke="#CBD5E1" stroke-width="2" />
                        <path d="M 26 20 H 66 V 27 H 26 Z" fill="#1E293B" />
                        <path d="M 46 -4 L 46 16" stroke="#475569" stroke-width="3" />
                        <path d="M 36 3 L 56 3" stroke="#6D28D9" stroke-width="2.5" />

                        <!-- Stacked Cargo Containers -->
                        <path d="M 78 54 H 130 V 86 H 78 Z" fill="#6D28D9" stroke="#FFFFFF" stroke-width="1.5" />
                        <path d="M 132 54 H 184 V 86 H 132 Z" fill="#F59E0B" stroke="#FFFFFF" stroke-width="1.5" />
                        <path d="M 186 54 H 238 V 86 H 186 Z" fill="#4C1D95" stroke="#FFFFFF" stroke-width="1.5" />
                        <path d="M 86 24 H 138 V 54 H 86 Z" fill="#8B5CF6" stroke="#FFFFFF" stroke-width="1.5" />
                        <path d="M 140 24 H 192 V 54 H 140 Z" fill="#0F172A" stroke="#FFFFFF" stroke-width="1.5" />
                        <path d="M 194 24 H 236 V 54 H 194 Z" fill="#7C3AED" stroke="#FFFFFF" stroke-width="1.5" />

                        <!-- Ship Hull -->
                        <path d="M 0 84 L 282 84 L 256 138 L 22 138 Z" fill="#1E293B" />
                        <path d="M 14 116 L 266 116 L 256 138 L 22 138 Z" fill="#6D28D9" />
                        <text x="115" y="106" fill="#FFFFFF" font-size="13" font-weight="800" font-family="sans-serif" letter-spacing="1">LANEX CARGO</text>
                        <path d="M 243 100 a 5 5 0 1 0 10 0 a 5 5 0 1 0 -10 0" fill="#F8FAFC" />
                    </g>
                </g>
            </g>

            <!-- Front Animated Ocean Waves -->
            <g class="svg-wave-a">
                <path d="M -20 256 Q 40 242, 100 256 T 220 256 T 340 256 T 460 256 T 540 256 L 540 325 L -20 325 Z" fill="#6D28D9" opacity="0.16" />
                <path d="M 35 276 Q 95 266, 155 276 T 275 276 T 395 276" stroke="#8B5CF6" stroke-width="2.5" stroke-linecap="round" fill="none" opacity="0.45" />
            </g>
        </svg>

    @elseif($scene === 'customs')
        <!-- SCENE 4: Representación Aduanera SUNAT (Automated Customs Scanner & Clearance Conveyor) -->
        <svg class="w-full h-auto block" viewBox="0 0 500 340" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Representación y despacho aduanero SUNAT">
            <path d="M 28 15 H 472 A 18 18 0 0 1 490 33 V 307 A 18 18 0 0 1 472 325 H 28 A 18 18 0 0 1 10 307 V 33 A 18 18 0 0 1 28 15 Z" fill="#F8FAFC" />

            <!-- SUNAT Documentation Verification Cards (Left Side) -->
            <g transform="translate(32, 46)">
                <path d="M 8 0 H 178 A 8 8 0 0 1 186 8 V 196 A 8 8 0 0 1 178 204 H 8 A 8 8 0 0 1 0 196 V 8 A 8 8 0 0 1 8 0 Z" fill="#FFFFFF" stroke="#CBD5E1" stroke-width="2" />
                <path d="M 14 14 H 172 V 42 H 14 Z" fill="#4C1D95" />
                <text x="93" y="32" text-anchor="middle" fill="#FFFFFF" font-size="9.5" font-weight="700" font-family="sans-serif" letter-spacing="0.8">GESTIÓN ADUANERA SUNAT</text>

                <!-- Check Row 1 -->
                <path d="M 16 56 H 170 V 88 H 16 Z" fill="#F8FAFC" stroke="#E2E8F0" />
                <path d="M 24 72 a 8 8 0 1 0 16 0 a 8 8 0 1 0 -16 0" fill="#6D28D9" />
                <path d="M 28.5 72 L 31 74.5 L 36 69.5" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <text x="48" y="75" fill="#0F172A" font-size="9.5" font-weight="700" font-family="sans-serif">Declaración DAM Validada</text>

                <!-- Check Row 2 -->
                <path d="M 16 98 H 170 V 130 H 16 Z" fill="#F8FAFC" stroke="#E2E8F0" />
                <path d="M 24 114 a 8 8 0 1 0 16 0 a 8 8 0 1 0 -16 0" fill="#6D28D9" />
                <path d="M 28.5 114 L 31 116.5 L 36 111.5" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <text x="48" y="117" fill="#0F172A" font-size="9.5" font-weight="700" font-family="sans-serif">Permisos y Regímenes</text>

                <!-- Check Row 3 -->
                <path d="M 16 140 H 170 V 172 H 16 Z" fill="#EDE9FE" stroke="#C4B5FD" />
                <path d="M 24 156 a 8 8 0 1 0 16 0 a 8 8 0 1 0 -16 0" fill="#4C1D95" />
                <path d="M 28.5 156 L 31 158.5 L 36 153.5" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <text x="48" y="159" fill="#4C1D95" font-size="9.5" font-weight="700" font-family="sans-serif">Levante Autorizado</text>
            </g>

            <!-- Customs Inspection Scanner Arch & Moving Packages (Right Side) -->
            <g transform="translate(242, 68)">
                <!-- Scanner Arch Frame -->
                <path d="M 24 0 H 196 A 12 12 0 0 1 208 12 V 188 H 184 V 28 H 36 V 188 H 12 V 12 A 12 12 0 0 1 24 0 Z" fill="#1E293B" />
                <path d="M 54 6 H 166 V 22 H 54 Z" fill="#6D28D9" />
                <text x="110" y="17.5" text-anchor="middle" fill="#FFFFFF" font-size="8.5" font-weight="700" font-family="sans-serif" letter-spacing="1">CANAL CONTROL</text>

                <!-- Animated Verification Scanner Beam -->
                <g class="svg-scan-beam">
                    <path d="M 40 28 L 180 28 L 192 174 L 28 174 Z" fill="#A855F7" opacity="0.22" />
                    <path d="M 38 98 H 182" stroke="#8B5CF6" stroke-width="2.5" stroke-dasharray="6 4" />
                </g>

                <!-- Conveyor Track -->
                <path d="M 0 176 H 224 V 192 H 0 Z" fill="#334155" />
                <path d="M 14 184 H 210" stroke="#94A3B8" stroke-width="3" stroke-dasharray="10 10" stroke-linecap="round" />

                <!-- Scroll-Moved Cargo Pallets Passing Through Customs Arch -->
                <g class="js-scroll-actor" data-move-x="44" data-move-y="0">
                    <g transform="translate(26, 112)">
                        <!-- Parcel 1 -->
                        <path d="M 0 10 H 56 V 64 H 0 Z" fill="#F59E0B" stroke="#D97706" stroke-width="2" />
                        <path d="M 22 10 H 34 V 28 H 22 Z" fill="#FEF3C7" />
                        <!-- Parcel 2 (Verified) -->
                        <path d="M 72 0 H 134 V 64 H 72 Z" fill="#EDE9FE" stroke="#6D28D9" stroke-width="2.5" />
                        <path d="M 91 32 a 12 12 0 1 0 24 0 a 12 12 0 1 0 -24 0" fill="#6D28D9" />
                        <path d="M 98 32 L 102 36 L 109 28" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                </g>
            </g>

            <path d="M 20 266 H 480" stroke="#CBD5E1" stroke-width="3" stroke-linecap="round" />
        </svg>

    @elseif($scene === 'consulting')
        <!-- SCENE 5: Asesoramiento & Consultoría de Comercio Exterior (Global Trade Analytics & Route Planning) -->
        <svg class="w-full h-auto block" viewBox="0 0 500 340" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Asesoramiento en comercio exterior LanEx">
            <path d="M 28 15 H 472 A 18 18 0 0 1 490 33 V 307 A 18 18 0 0 1 472 325 H 28 A 18 18 0 0 1 10 307 V 33 A 18 18 0 0 1 28 15 Z" fill="#F8FAFC" />

            <!-- Global Trade Dashboard Board -->
            <g transform="translate(45, 42)">
                <path d="M 12 0 H 398 A 12 12 0 0 1 410 12 V 232 A 12 12 0 0 1 398 244 H 12 A 12 12 0 0 1 0 232 V 12 A 12 12 0 0 1 12 0 Z" fill="#FFFFFF" stroke="#CBD5E1" stroke-width="2" />
                <path d="M 0 12 A 12 12 0 0 1 12 0 H 398 A 12 12 0 0 1 410 12 V 38 H 0 Z" fill="#1E293B" />
                <text x="24" y="24" fill="#FFFFFF" font-size="10" font-weight="700" font-family="sans-serif" letter-spacing="1">PLANEAMIENTO DE COMERCIO EXTERIOR · LANEX</text>

                <!-- Left Panel: Cost Optimization Bars -->
                <g transform="translate(24, 58)">
                    <text x="0" y="12" fill="#475569" font-size="9.5" font-weight="700" font-family="sans-serif">OPTIMIZACIÓN DE COSTOS Y TIEMPOS</text>
                    <path d="M 0 26 H 165 V 40 H 0 Z" fill="#F1F5F9" />
                    <path d="M 0 26 H 138 V 40 H 0 Z" fill="#6D28D9" />
                    <path d="M 0 50 H 165 V 64 H 0 Z" fill="#F1F5F9" />
                    <path d="M 0 50 H 152 V 64 H 0 Z" fill="#8B5CF6" />
                    <path d="M 0 74 H 165 V 88 H 0 Z" fill="#F1F5F9" />
                    <path d="M 0 74 H 124 V 88 H 0 Z" fill="#A78BFA" />

                    <!-- Incoterms / TLC Badge -->
                    <path d="M 0 108 H 165 V 156 H 0 Z" fill="#EDE9FE" stroke="#C4B5FD" />
                    <text x="14" y="128" fill="#4C1D95" font-size="10" font-weight="800" font-family="sans-serif">NORMATIVA &amp; TLC VIGENTES</text>
                    <text x="14" y="144" fill="#6D28D9" font-size="9" font-weight="600" font-family="sans-serif">FOB · CIF · EXW · DDP</text>
                </g>

                <!-- Right Panel: Animated Global Trade Globe & Route Plane -->
                <g transform="translate(295, 138)">
                    <path d="M -68 0 a 68 68 0 1 0 136 0 a 68 68 0 1 0 -136 0" fill="#F8FAFC" stroke="#CBD5E1" stroke-width="2" />
                    <path d="M -32 0 a 32 68 0 1 0 64 0 a 32 68 0 1 0 -64 0" stroke="#DDD6FE" stroke-width="2" fill="none" />
                    <path d="M -68 0 H 68 M -58 -32 H 58 M -58 32 H 58" stroke="#E2E8F0" stroke-width="1.5" />
                    <path d="M -48 24 Q 0 -45, 48 -18" stroke="#6D28D9" stroke-width="3" stroke-dasharray="5 4" fill="none" />
                    <path d="M -53 24 a 5 5 0 1 0 10 0 a 5 5 0 1 0 -10 0" fill="#6D28D9" />
                    <path d="M 43 -18 a 5 5 0 1 0 10 0 a 5 5 0 1 0 -10 0" fill="#F59E0B" />

                    <!-- Scroll-Moved Route Indicator along Globe -->
                    <g class="js-scroll-actor" data-move-x="28" data-move-y="-16">
                        <g transform="translate(-24, 4)">
                            <path d="M -14 0 a 14 14 0 1 0 28 0 a 14 14 0 1 0 -28 0" fill="#6D28D9" />
                            <path d="M -5 1 L -1 5 L 6 -3" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                    </g>
                </g>
            </g>
        </svg>

    @elseif($scene === 'route')
        <!-- SCENE 7: Ruta Operativa · Flujo Integral (Blueprint interactivo) -->
        <div class="flex items-center justify-between pb-3.5 mb-3.5 border-b border-slate-800/90 text-xs">
            <span class="font-mono uppercase tracking-wider text-slate-300">{{ __('RUTA OPERATIVA · FLUJO INTEGRAL') }}</span>
            <span class="font-mono font-bold text-purple-400">LANEX</span>
        </div>
        <svg class="w-full h-auto block" viewBox="0 0 420 280" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="{{ $title ?? 'Diagrama operativo LanEx' }}">
            <path d="M 70 55 C 210 55, 210 140, 350 140 C 210 140, 210 225, 70 225 L 350 225" stroke="#334155" stroke-width="2.5" stroke-dasharray="5 5" stroke-linecap="round" fill="none" />
            <path class="js-scroll-mainpath" d="M 70 55 C 210 55, 210 140, 350 140 C 210 140, 210 225, 70 225 L 350 225" stroke="#8B5CF6" stroke-width="3.5" stroke-linecap="round" fill="none" pathLength="100" stroke-dasharray="100" stroke-dashoffset="0" />
            <g transform="translate(70, 55)">
                <circle r="20" fill="#0F172A" stroke="#A855F7" stroke-width="2" />
                <text x="0" y="4" text-anchor="middle" fill="#E2E8F0" font-size="10" font-weight="700" font-family="monospace">01</text>
                <text x="32" y="4" fill="#E2E8F0" font-size="10" font-weight="700" font-family="monospace">ANÁLISIS &amp; COSTOS</text>
            </g>
            <g transform="translate(350, 140)">
                <circle r="20" fill="#0F172A" stroke="#A855F7" stroke-width="2" />
                <text x="0" y="4" text-anchor="middle" fill="#E2E8F0" font-size="10" font-weight="700" font-family="monospace">02</text>
                <text x="-155" y="4" fill="#E2E8F0" font-size="10" font-weight="700" font-family="monospace">GESTIÓN ADUANERA</text>
            </g>
            <g transform="translate(350, 225)">
                <circle r="20" fill="#0F172A" stroke="#A855F7" stroke-width="2" />
                <text x="0" y="4" text-anchor="middle" fill="#E2E8F0" font-size="10" font-weight="700" font-family="monospace">03</text>
                <text x="-165" y="4" fill="#E2E8F0" font-size="10" font-weight="700" font-family="monospace">PLANEAMIENTO GLOBAL</text>
            </g>
        </svg>

    @elseif($isCustomAsset)
        <!-- SCENE CUSTOM: SVG o Imagen personalizada subida desde el Panel -->
        @php
            $cleanRelPath = ltrim($scene, '/');
            $storageSvgFile = storage_path('app/public/' . $cleanRelPath);
            $publicSvgFile = public_path($cleanRelPath);
            $inlineSvgMarkup = null;

            if (str_ends_with(strtolower($cleanRelPath), '.svg')) {
                if (file_exists($storageSvgFile)) {
                    $rawContent = file_get_contents($storageSvgFile);
                    if (str_contains($rawContent, '<svg')) {
                        $inlineSvgMarkup = $rawContent;
                    }
                } elseif (file_exists($publicSvgFile)) {
                    $rawContent = file_get_contents($publicSvgFile);
                    if (str_contains($rawContent, '<svg')) {
                        $inlineSvgMarkup = $rawContent;
                    }
                }
            }

            $assetUrl = str_starts_with($scene, 'http')
                ? $scene
                : (file_exists($storageSvgFile) ? asset('storage/' . $cleanRelPath) : asset($cleanRelPath));
        @endphp
        <div class="w-full min-h-[220px] flex items-center justify-center p-2 [&>svg]:w-full [&>svg]:h-auto [&>svg]:max-h-[320px] [&>svg]:block">
            @if($inlineSvgMarkup)
                {!! $inlineSvgMarkup !!}
            @else
                <img src="{{ $assetUrl }}" alt="{{ $title ?? 'Ilustración de servicio LanEx' }}" class="w-full h-auto max-h-[320px] object-contain rounded-xl mx-auto" />
            @endif
        </div>

    @else
        <!-- SCENE 6: Camión de Distribución y Coordinación Puerta a Puerta (Properly Centered Spinning Wheels) -->
        <svg class="w-full h-auto block" viewBox="0 0 500 340" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Transporte y distribución de carga LanEx">
            <path d="M 28 15 H 472 A 18 18 0 0 1 490 33 V 307 A 18 18 0 0 1 472 325 H 28 A 18 18 0 0 1 10 307 V 33 A 18 18 0 0 1 28 15 Z" fill="#F8FAFC" />

            <!-- City Warehouse Backdrop -->
            <g opacity="0.5" fill="#E2E8F0">
                <path d="M 45 95 H 100 V 260 H 45 Z" />
                <path d="M 110 125 H 180 V 260 H 110 Z" />
                <path d="M 370 105 H 450 V 260 H 370 Z" />
            </g>

            <!-- Road Surface -->
            <path d="M 20 262 L 480 262" stroke="#334155" stroke-width="4" stroke-linecap="round" />
            <path d="M 40 276 L 460 276" stroke="#CBD5E1" stroke-width="2.5" stroke-dasharray="16 14" stroke-linecap="round" />

            <!-- Scroll-Driven LanEx Delivery Truck -->
            <g class="js-scroll-actor" data-move-x="65" data-move-y="0">
                <g transform="translate(75, 118)">
                    <g class="svg-body-bob">
                        <path d="M 10 0 H 175 A 10 10 0 0 1 185 10 V 102 A 10 10 0 0 1 175 112 H 10 A 10 10 0 0 1 0 102 V 10 A 10 10 0 0 1 10 0 Z" fill="#6D28D9" />
                        <path d="M 18 14 H 167 A 6 6 0 0 1 173 20 V 92 A 6 6 0 0 1 167 98 H 18 A 6 6 0 0 1 12 92 V 20 A 6 6 0 0 1 18 14 Z" fill="#7C3AED" />
                        <text x="92" y="58" text-anchor="middle" fill="#FFFFFF" font-size="20" font-weight="800" font-family="sans-serif" letter-spacing="1">LanEx</text>
                        <text x="92" y="76" text-anchor="middle" fill="#DDD6FE" font-size="9" font-weight="600" font-family="sans-serif" letter-spacing="1.5">PUERTA A PUERTA</text>

                        <!-- Truck Cab -->
                        <path d="M 185 32 L 242 32 C 254 32, 264 42, 268 58 L 274 84 C 276 92, 274 112, 264 112 L 185 112 Z" fill="#FFFFFF" stroke="#CBD5E1" stroke-width="2" />
                        <path d="M 198 42 L 244 42 L 256 72 L 198 72 Z" fill="#1E293B" />
                        <path d="M 185 96 H 275 V 110 H 185 Z" fill="#1E293B" />
                        <path d="M 266 82 H 274 V 92 H 266 Z" fill="#F59E0B" />
                    </g>

                    <!-- Rear Wheel at (52, 118) -->
                    <g transform="translate(52, 118)">
                        <g class="svg-wheel-spin">
                            <path d="M -24 0 a 24 24 0 1 0 48 0 a 24 24 0 1 0 -48 0" fill="#0F172A" />
                            <path d="M -11 0 a 11 11 0 1 0 22 0 a 11 11 0 1 0 -22 0" fill="#E2E8F0" />
                            <path d="M -16 0 L 16 0 M 0 -16 L 0 16" stroke="#64748B" stroke-width="3" />
                        </g>
                    </g>

                    <!-- Front Wheel at (228, 118) -->
                    <g transform="translate(228, 118)">
                        <g class="svg-wheel-spin">
                            <path d="M -24 0 a 24 24 0 1 0 48 0 a 24 24 0 1 0 -48 0" fill="#0F172A" />
                            <path d="M -11 0 a 11 11 0 1 0 22 0 a 11 11 0 1 0 -22 0" fill="#E2E8F0" />
                            <path d="M -16 0 L 16 0 M 0 -16 L 0 16" stroke="#64748B" stroke-width="3" />
                        </g>
                    </g>
                </g>
            </g>
        </svg>
    @endif
</div>
