<!-- resources/views/components/navbar.blade.php -->
<nav id="navbar" class="w-full flex flex-col h-auto z-50">
    <div class="w-full flex justify-between items-center bg-primary-dark px-20 h-[60px]">
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
    <div class="w-full mx-auto flex justify-between items-center bg-white text-body px-20 h-[80px]">
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
        <div class="w-auto h-auto flex flex-row text-primary-dark">
            <div class="w-auto h-auto flex flex-row gap-x-4">
                <a href="#"><label class="font-bold hover:text-primary duration-300 cursor-pointer">Inicio</label></a>
                <a href="#"><label class="font-bold hover:text-primary duration-300 cursor-pointer">Nosotros</label></a>
                <a href="#"><label class="font-bold hover:text-primary duration-300 cursor-pointer">Servicios</label></a>
                <a href="#"><label class="font-bold hover:text-primary duration-300 cursor-pointer">Proveedores</label></a>
                <a href="#"><label class="font-bold hover:text-primary duration-300 cursor-pointer">Contactanos</label></a>
            </div>
            <div>
                @if($user)
                    <span class="text-white">Hello, {{ $user->name }}</span>
                    <form action="#" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-white ml-4">Logout</button>
                    </form>
                @else
                    <a href="#" class="text-white">Login</a>
                @endif
            </div>
        </div>
    </div>
</nav>

