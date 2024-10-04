@extends('layouts.client')


@section('content-client')
    <section id="quote_hero_section" class="w-full h-auto bg-white text-body pt-[80px] pt:mt-[140px]">
    <div class="relative w-full h-auto px-4 sm:px-24 xl:px-48 py-12 sm:py-24 xl:py-36 flex flex-col-reverse xl:flex-row justify-start items-start gap-y-6 sm:gap-x-12 xl:gap-x-24 animation-group">
        <div class="w-full xl:w-1/2 h-full flex flex-col justify-start xl:justify-center items-start gap-y-6">
            <form class="w-full h-full border-2 border-gray-light rounded-xl flex flex-col justify-start items-start px-4 py-6 sm:p-6 gap-y-6 text-primary-dark animation-element slide-in-up">
                <h5>
                    Envianos la informacion para realizarte una cotizacion
                </h5>
                <div class="w-full h-auto grid grid-cols-2 gap-6 mt-6 ">
                    <div class="col-span-1 h-auto flex flex-col ">
                        <div class="flex flex-col w-full h-auto">
                            <div class="flex flex-row w-full h-auto gap-x-2">
                                <x-bi-airplane-fill class="text-primary h-6 w-6"/>
                                <p class="font-bold text-secondary-dark">
                                    Numero de Vuelo
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
                                    Fecha de Salida
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
                                    Fecha de Llegada
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
                                    Direccion de Entrega
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
                                    Identificador de Proveedor
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
                                    Identificador de Cliente
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
                                    Identificador de Producto
                                </p>
                            </div>
                            <div class="flex flex-row justify-start items-center border-b-2 border-primary text-secondary-dark py-2">
                                    12312312312312
                            </div>
                        </div>

                    </div>
                </div>
                <div class="w-full h-auto">
                    <label for="contact_form_email" class="font-bold">Correo Electronico</span>
                    <input id="contact_form_email" name="email" type="email"  class="w-full h-auto p-4 border-2 border-secondary-dark rounded-lg text-secondary-dark placeholder:text-secondary-dark mt-4 focus:border-2 focus:border-primary focus:outline-none" placeholder="Correo Electronico " />
                </div>
                <div class="w-full h-auto">
                    <label for="contact_form_message" class="font-bold">Mensaje Adicional</span>
                    <textarea id="contact_form_message" name="message"  class="w-full h-auto p-4 border-2 border-secondary-dark rounded-lg text-secondary-dark placeholder:text-secondary-dark mt-4 focus:border-2 focus:border-primary focus:outline-none" >Mensaje</textarea>
                </div>
                <button type="submit" class="bg-primary-dark px-12 sm:px-24 py-2 sm:py-4 lg:py-3 text-white font-bold duration-300 active:scale-95 rounded-xl hover:bg-secondary-dark mx-auto">
                    <span>Cotizar Ahora</span>
                </button>
            </form>
        </div>
        <div class="w-full xl:w-1/2 h-full flex flex-col justify-start items-start gap-y-6 max-sm:mt-12">
            <div class="h-auto h-full w-full flex flex-col justify-start items-end relative">
                <h5 class="animation-element slide-in-up text-right">
                    Contactanos
                </h5>
                <h1 class="text-primary-dark font-bold animation-element slide-in-up text-right">
                    Envianos Cualquier Duda que tengas
                </h1>
                <div class="w-full h-full flex justify-center items-center p-6 sm:p-4 mt-6 sm:mt-12 animation-element slide-in-up">
                    <img src="/images/svg/quote.svg" class="h-48 sm:h-96 w-auto" />
                </div>
            </div>
        </div>
    </div>
    </section>
    <x-questions title="Frequently asked questions" :questions="$questions" />
@endsection
