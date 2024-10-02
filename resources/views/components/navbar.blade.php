<!-- resources/views/components/navbar.blade.php -->
<nav id="navbar" class="absolute top-0 left-0 right-0 w-full flex flex-col h-auto z-50">
    <div class="hidden xl:flex w-full justify-between items-center bg-primary-dark px-20 h-[60px]">
        <div class="w-auto h-auto
            divide-x divide-dashed
            flex justify-center items-center text-white">
            <label class="px-4">
                operaciones@lanex.com
            </label>
            <label class="px-4">
                +1 (333) 000-0000
            </label>
        </div>
        <div class="w-auto h-auto
            flex justify-center gap-x-4 items-center">
            <livewire:button-link url="#" text="Cotizar" />
            <livewire:button-link url="#" text="Track" variant="secondary" />
        </div>
    </div>
    <div class="w-full mx-auto flex justify-between items-center bg-transparent xl:bg-white text-body px-6 sm:px-12 xl:px-20 h-[80px] max-xl:mt-12">
        <div class="w-full h-auto flex flex-row items-center">
            <div class="w-[60px] h-auto p-none">
                <img src="/images/logo.png" class="h-auto w-full" />
            </div>
            <div class="w-auto flex flex-row">
                <h2 class="font-bold text-primary">
                    Lan
                </h2>
                <h2 class="font-bold text-primary-dark">
                    Ex
                </h2>
            </div>
        </div>
        <div class="hidden xl:flex w-auto h-auto flex-row text-primary-dark">
            <div class="w-auto h-auto flex flex-row gap-x-4">
                <a href="#"><label class="font-bold hover:text-primary duration-300 cursor-pointer">Inicio</label></a>
                <a href="#"><label class="font-bold hover:text-primary duration-300 cursor-pointer">Nosotros</label></a>
                <a href="#"><label class="font-bold hover:text-primary duration-300 cursor-pointer">Servicios</label></a>
                <a href="#"><label class="font-bold hover:text-primary duration-300 cursor-pointer">Proveedores</label></a>
                <a href="#"><label class="font-bold hover:text-primary duration-300 cursor-pointer">Contactanos</label></a>
            </div>
        </div>
        <div class="navbar_menu_toggle_button flex xl:hidden justify-center items-center bg-primary p-2 rounded-xl shadow-md active:scale-95 duration-300">
            <x-heroicon-o-bars-3 class="h-6 sm:h-12 w-6 sm:w-12 text-white" />
        </div>
    </div>
    <div id="navbar_menu_scroll" class="fixed top-0 left-0 bottom-0 right-0 w-screen h-screen bg-white translate-x-[100%] transition-all duration-300 xl:hidden flex flex-col justify-start item-start p-12 sm:p-16">
        <div class="navbar_menu_toggle_button ml-auto w-auto flex justify-center items-center bg-primary p-2 rounded-xl shadow-md active:scale-95 duration-300">
            <x-heroicon-o-x-mark class="h-6 sm:h-12 w-6 sm:w-12 text-white" />
        </div>
        <div class="w-full h-auto flex flex-row items-center">
            <div class="w-[60px] h-auto p-none">
                <img src="/images/logo.png" class="h-auto w-full" />
            </div>
            <div class="w-auto flex flex-row">
                <h1 class="font-bold text-primary">
                    Lan
                </h2>
                <h1 class="font-bold text-primary-dark">
                    Ex
                </h2>
            </div>
        </div>
        <div class="w-auto h-auto flex flex-col gap-y-6 sm:gap-y-12 text-primary mt-12">
            <a href="#"><h4 class="font-bold hover:text-primary-dark duration-300 cursor-pointer">Inicio</h4></a>
            <a href="#"><h4 class="font-bold hover:text-primary-dark duration-300 cursor-pointer">Nosotros</h4></a>
            <a href="#"><h4 class="font-bold hover:text-primary-dark duration-300 cursor-pointer">Servicios</h4></a>
            <a href="#"><h4 class="font-bold hover:text-primary-dark duration-300 cursor-pointer">Proveedores</h4></a>
            <a href="#"><h4 class="font-bold hover:text-primary-dark duration-300 cursor-pointer">Contactanos</h4></a>
        </div>
        <div class="w-auto h-auto
            flex flex-row justify-start gap-x-4 items-center mt-12">
            <livewire:button-link url="#" text="Cotizar" extraClasses="px-12 py-2" />
            <livewire:button-link url="#" text="Track" extraClasses="px-12 py-2" />
        </div>
        <div class="flex flex-row gap-x-6 mt-auto text-primary">
            <a href="">
                <x-bi-facebook class="w-8 sm:w-12 h-8 sm:h-12" />
            </a>
            <a href="">
                <x-bi-instagram class="w-8 sm:w-12 h-8 sm:h-12"/>
            </a>
            <a href="">
                <x-bi-twitter class="w-8 sm:w-12 h-8 sm:h-12"/>
            </a>
            <a href="">
                <x-bi-tiktok class="w-8 sm:w-12 h-8 sm:h-12"/>
            </a>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select the button and the menu
        const menuButtons = document.querySelectorAll('.navbar_menu_toggle_button');
        const menu = document.querySelector('#navbar_menu_scroll');

        // Toggle function to translate the div
        menuButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (menu.classList.contains('translate-x-[100%]')) {
                    menu.classList.add('translate-x-0');
                    menu.classList.remove('translate-x-[100%]');
                } else {
                    menu.classList.add('translate-x-[100%]');
                    menu.classList.remove('translate-x-0');
                }
            });
        })
    });
</script>

