<!-- resources/views/components/navbar.blade.php -->

<nav class="w-full flex flex-col">
    <div class="container flex justify-between items-center bg-primary-dark">
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
            flex justify-center gap-x-4 items-center text-white">
            <livewire:button-link url="#" text="Cotizar" />
            <livewire:button-link url="#" text="Track" />
        </div>
    </div>
    <div class="container mx-auto flex justify-between items-center text-body">
        <div>
            <a href="#" class="text-white">Home</a>
            <a href="#" class="text-white ml-4">About</a>
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
</nav>

