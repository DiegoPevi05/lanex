<div class="w-full h-full flex flex-col justify-start items-start p-8 rounded-xl {{ $variant == 'secondary' ? 'bg-primary': ''}}">
    <div class="w-full h-auto flex flex-row justify-start items-center ">
        @for ($i = 0; $i < $stars; $i++)
            <x-heroicon-s-star class="h-10 w-10 {{ $variant == 'secondary' ? 'text-white': 'text-primary'}}" />
        @endfor
    </div>
    <p class="mt-4 {{ $variant == 'secondary' ? 'text-white': 'text-body'}}">
        {{$content}}
    </p>
    <span class="mt-auto {{ $variant == 'secondary' ? 'text-white': 'text-body'}}"> {{$name}}, {{$charge}}</span>
</div>