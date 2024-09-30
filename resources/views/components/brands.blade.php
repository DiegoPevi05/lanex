    <section id="brands" class="w-full {{ $variant == 'secondary' ? 'bg-white': 'bg-primary-dark' }} h-auto flex flex-col justify-center items-center padding gap-y-12">
        <h3 class="font-bold {{ $variant == 'secondary' ? 'text-primary-dark': 'text-white' }}">{{$title}}</h3>
        <div class="w-full flex flex-row justify-start items-start">

          <div class="relative w-full h-auto overflow-hidden">

            <div class="w-full h-auto py-6 reviews">
              <div class="h-full flex flex-row justify-start items-center reviews-slide p-0">
                @foreach ($brands as $brand)
                  <div class="reviews-slide-card w-[280px] h-[40px] flex justify-center items-center px-12">
                    <img src="{{$brand}}" class="w-auto h-full">
                  </div>
                @endforeach
              </div>
              <div class="h-full flex flex-row justify-start items-center reviews-slide p-0">
                @foreach ($brands as $brand)
                  <div class="reviews-slide-card w-[280px] h-[40px] flex justify-center items-center px-12">
                    <img src="{{$brand}}" class="w-auto h-full">
                  </div>
                @endforeach
              </div>
            </div>
          </div>

        </div>
    </section>
