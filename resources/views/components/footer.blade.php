<!-- resources/views/components/navbar.blade.php -->
<footer id="footer" class="p-4 flex flex-col padding text-secondary-dark">
    <div class="w-full h-auto grid grid-cols-4 gap-12">
        <div class="col-span-1 flex flex-col gap-y-4 justify-start items-start">

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
            <p>At FastGo, we believe in providing our clients with personalized and efficient logistics solutions that meet their unique needs.</p>
            <div class="flex flex-row gap-x-4">
                <a href="">
                    <x-bi-facebook class="w-8 h-8" />
                </a>
                <a href="">
                    <x-bi-instagram class="w-8 h-8"/>
                </a>
                <a href="">
                    <x-bi-twitter class="w-8 h-8"/>
                </a>
                <a href="">
                    <x-bi-tiktok class="w-8 h-8"/>
                </a>
            </div>
        </div>

        <div class="col-span-1 flex flex-col gap-y-4 justify-start items-center">
            <span class="font-bold">Navigacion</span>
            <div class="flex flex-col justify-start items-start gap-y-4">
                <span><a href="#" class="hover:underline">Home</a></span>
                <span><a href="#" class="hover:underline">About Us</a></span>
                <span><a href="#" class="hover:underline">Services</a></span>
                <span><a href="#" class="hover:underline">Contact Us</a></span>
            </div>
        </div>

        <div class="col-span-1 flex flex-col gap-y-4 justify-start items-start">

            <span class="font-bold">Proyectos recientes</span>
            <div class="w-full h-full bg-secondary-dark rounded-xl">

            </div>
        </div>

        <div class="col-span-1 flex flex-col gap-y-4 justify-start items-start">
            <span class="font-bold">Subscribete</span>
            <input placeholder="Ingresa tu correo" class="w-full bg-body border-2 border-body rounded-md p-4 text-sm placeholder:text-secondary text-secondary" />
            <livewire:button-link text="Subscribete Ahora" variant="tertiary" url="#" extraClasses="uppercase py-4 w-full"/>
        </div>
    </div>
</footer>

