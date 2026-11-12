@section('title', 'Libro de Reclamaciones Virtual | LanEx')
@section('meta_description', 'Libro de Reclamaciones Virtual de LanEx - Express Lane Logistics S.A.C. Conforme a la Ley N° 29571 Código de Protección y Defensa del Consumidor.')
@extends('layouts.client')

@section('content-client')
<section data-enter class="w-full bg-slate-50 pt-[160px] xl:pt-[190px] pb-16 sm:pb-24 border-b border-slate-200/80">
    <div class="max-w-4xl mx-auto px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <span class="hero-enter-item text-xs font-bold uppercase tracking-widest text-primary block mb-2">
                {{ __('ATENCIÓN AL CONSUMIDOR — LEY N° 29571') }}
            </span>
            <h1 class="hero-enter-item text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight leading-tight font-display">
                {{ __('Libro de Reclamaciones Virtual') }}
            </h1>
            <p class="hero-enter-item text-slate-600 text-base mt-3 max-w-2xl mx-auto leading-relaxed">
                {{ __('Conforme a lo establecido en el Código de Protección y Defensa del Consumidor, ponemos a su disposición nuestro Libro de Reclamaciones Virtual.') }}
            </p>
        </div>

        @if(session('success'))
            <div class="mb-8 p-6 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                <div>
                    <h2 class="font-bold text-sm text-emerald-900 mb-1">{{ __('Registro Exitoso') }}</h2>
                    <p class="text-xs sm:text-sm text-emerald-800 leading-relaxed">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Form Container -->
        <div class="hero-enter-item bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6 sm:p-10">
            <!-- Business Info Notice (Flattened, no nested border box) -->
            <div class="pb-6 mb-6 border-b border-slate-100 grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs text-slate-600">
                <div>
                    <span class="font-bold text-slate-900 block">{{ __('Razón Social:') }}</span>
                    <span>EXPRESS LANE LOGISTICS S.A.C.</span>
                </div>
                <div>
                    <span class="font-bold text-slate-900 block">{{ __('Nombre Comercial:') }}</span>
                    <span>LanEx</span>
                </div>
                <div>
                    <span class="font-bold text-slate-900 block">RUC:</span>
                    <span>20612739481</span>
                </div>
                <div>
                    <span class="font-bold text-slate-900 block">{{ __('Domicilio Legal:') }}</span>
                    <span>Callao, Perú — operaciones@lanexsac.com</span>
                </div>
            </div>

            <!-- Definitions Note (Border left accent instead of full nested card) -->
            <div class="pl-4 py-1 border-l-2 border-primary text-xs text-slate-700 mb-8 leading-relaxed">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <strong class="text-primary font-bold block mb-0.5">{{ __('Reclamo:') }}</strong>
                        {{ __('Disconformidad relacionada a los productos y/o servicios brindados.') }}
                    </div>
                    <div>
                        <strong class="text-primary font-bold block mb-0.5">{{ __('Queja:') }}</strong>
                        {{ __('Malestar o descontento respecto a la atención al público recibida.') }}
                    </div>
                </div>
            </div>

            <form action="{{ route('claims.submit') }}" method="POST" class="flex flex-col gap-8">
                @csrf

                <!-- Section 1: Consumer Info -->
                <div class="flex flex-col gap-4">
                    <h2 class="text-base font-bold text-slate-900 pb-2 border-b border-slate-100 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-primary text-white text-xs flex items-center justify-center font-bold">1</span>
                        {{ __('Identificación del Consumidor Reclamante') }}
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label for="full_name" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('Nombre Completo o Razón Social *') }}</label>
                            <input type="text" id="full_name" name="full_name" required value="{{ old('full_name') }}" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-slate-900 text-sm focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none" placeholder="{{ __('Ej: Juan Pérez o Empresa SAC') }}">
                        </div>

                        <div>
                            <label for="doc_type" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('Tipo de Documento *') }}</label>
                            <select id="doc_type" name="doc_type" required class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-slate-900 text-sm focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none bg-white">
                                <option value="DNI">DNI</option>
                                <option value="RUC">RUC</option>
                                <option value="CE">{{ __('Carnet de Extranjería') }}</option>
                                <option value="Pasaporte">{{ __('Pasaporte') }}</option>
                            </select>
                        </div>

                        <div>
                            <label for="doc_number" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('Número de Documento *') }}</label>
                            <input type="text" id="doc_number" name="doc_number" required value="{{ old('doc_number') }}" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-slate-900 text-sm focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none" placeholder="{{ __('Número') }}">
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('Correo Electrónico *') }}</label>
                            <input type="email" id="email" name="email" required value="{{ old('email') }}" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-slate-900 text-sm focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none" placeholder="{{ __('ejemplo@correo.com') }}">
                        </div>

                        <div>
                            <label for="phone" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('Teléfono / WhatsApp *') }}</label>
                            <input type="tel" id="phone" name="phone" required value="{{ old('phone') }}" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-slate-900 text-sm focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none" placeholder="+51 999 999 999">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="address" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('Domicilio (Dirección, Distrito, Ciudad) *') }}</label>
                            <input type="text" id="address" name="address" required value="{{ old('address') }}" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-slate-900 text-sm focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none" placeholder="{{ __('Av. Principal 123, Callao, Lima') }}">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Contracted Good/Service -->
                <div class="flex flex-col gap-4">
                    <h2 class="text-base font-bold text-slate-900 pb-2 border-b border-slate-100 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-primary text-white text-xs flex items-center justify-center font-bold">2</span>
                        {{ __('Identificación del Bien Contratado') }}
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="service_type" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('Servicio Contratado o Tipo de Carga *') }}</label>
                            <input type="text" id="service_type" name="service_type" required value="{{ old('service_type') }}" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-slate-900 text-sm focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none" placeholder="{{ __('Ej: Flete Marítimo, Despacho Aduanero, Guía N°') }}">
                        </div>

                        <div>
                            <label for="amount" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('Monto Reclamado (Opcional)') }}</label>
                            <input type="text" id="amount" name="amount" value="{{ old('amount') }}" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-slate-900 text-sm focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none" placeholder="USD / PEN">
                        </div>
                    </div>
                </div>

                <!-- Section 3: Claim Details -->
                <div class="flex flex-col gap-4">
                    <h2 class="text-base font-bold text-slate-900 pb-2 border-b border-slate-100 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-primary text-white text-xs flex items-center justify-center font-bold">3</span>
                        {{ __('Detalle de la Reclamación y Pedido del Consumidor') }}
                    </h2>

                    <div class="flex flex-col gap-3">
                        <span class="block text-xs font-semibold text-slate-700">{{ __('Tipo de Reclamación *') }}</span>
                        <div class="flex items-center gap-6">
                            <label class="flex items-center gap-2 text-sm text-slate-700 cursor-pointer">
                                <input type="radio" name="claim_type" value="reclamo" checked class="w-4 h-4 text-primary focus:ring-primary">
                                <span class="font-semibold text-slate-900">{{ __('Reclamo') }}</span> {{ __('(Disconformidad con el servicio)') }}
                            </label>
                            <label class="flex items-center gap-2 text-sm text-slate-700 cursor-pointer">
                                <input type="radio" name="claim_type" value="queja" class="w-4 h-4 text-primary focus:ring-primary">
                                <span class="font-semibold text-slate-900">{{ __('Queja') }}</span> {{ __('(Malestar en la atención)') }}
                            </label>
                        </div>
                    </div>

                    <div>
                        <label for="detail" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('Detalle del Reclamo o Queja *') }}</label>
                        <textarea id="detail" name="detail" rows="4" required class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-slate-900 text-sm focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none leading-relaxed" placeholder="{{ __('Describa de manera clara y detallada lo ocurrido...') }}">{{ old('detail') }}</textarea>
                    </div>

                    <div>
                        <label for="request" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('Pedido Concreto del Consumidor *') }}</label>
                        <textarea id="request" name="request" rows="3" required class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-slate-900 text-sm focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none leading-relaxed" placeholder="{{ __('Indique qué solución o acción solicita...') }}">{{ old('request') }}</textarea>
                    </div>
                </div>

                <!-- Legal Consent (Inline layout, no nested border box) -->
                <div class="pt-4 text-xs text-slate-600 leading-relaxed flex items-start gap-2.5">
                    <input type="checkbox" id="terms" required class="mt-0.5 rounded border-slate-300 text-primary focus:ring-primary">
                    <label for="terms">
                        {{ __('Declaro ser el titular del servicio o reclamo, y que la información consignada es verídica. Autorizo el tratamiento de mis datos personales únicamente para la atención y seguimiento de esta reclamación, conforme a la Ley N° 29733 de Protección de Datos Personales.') }}
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
                    <span class="text-xs text-slate-500">
                        {{ __('* Plazo de respuesta legal: hasta 15 días hábiles.') }}
                    </span>

                    <button
                        type="submit"
                        class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-sm transition-all duration-200 shadow-md shadow-primary/20 active:scale-98 cursor-pointer"
                    >
                        {{ __('Registrar Reclamación') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
