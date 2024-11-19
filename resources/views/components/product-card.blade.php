<div id="product_card_{{$product['id']}}" class="w-full h-full rounded-xl shadow-xl flex flex-col text-body py-4 px-6" style="background-color: rgba(255, 255, 255, 0.6);">
    <div class="h-auto w-full flex justify-center items-center">
        <div class="h-24 w-24 flex justify-center items-center border-2 border-gray-light rounded-xl p-1">
            <img src="{{asset ('storage/'. $product['image'])}}" class="w-auto h-full" />
        </div>
    </div>
    <div class="h-auto w-full flex flex-col justify-start items-center gap-y-3">
        <div class="w-full flex flex-row justify-center items-center">
            @for ($i = 0; $i < $product['stars']; $i++)
                <x-heroicon-s-star class="h-6 sm:h-10 w-6 sm:w-10 text-primary" />
            @endfor
        </div>
        <p class="font-bold text-center">{{$product['name']}}</p>
        <p class="!text-xs text-justify hidden xl:block">{{$product['description']}} </p>
    </div>
    <div class="h-full w-full flex justify-center items-center mt-6">
        <x-button :url="route('quote') . '?type=product&id=' . $product['id']" text="Cotizar Ahora" variant="primary"/>
    </div>
</div>
