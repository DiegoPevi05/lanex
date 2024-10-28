    <section id="brands" class="w-full {{ $variant == 'secondary' ? 'bg-white padding-x': 'bg-primary-dark padding' }} h-auto flex flex-col justify-center items-center  gap-y-12">
        @if($variant != 'secondary')
            <h3 class="max-sm:text-center font-bold uppercase {{ $variant == 'secondary' ? 'text-primary-dark': 'text-white' }}">{{$title}}</h3>
        @endif
        <div class="w-full flex flex-row justify-start items-start">

          <div class="relative w-full h-auto overflow-hidden">

            <div class="w-full h-auto {{ $variant == 'secondary' ? 'py-12' : 'py-6' }} reviews">
              <div class="h-full flex flex-row justify-start items-center reviews-slide p-0">
                @foreach ($suppliers as $supplier)
                <a href="{{route('supplier',$supplier['id'])}}" class="p-none m-none">
                  <div class="reviews-slide-card w-[280px] h-[40px] flex justify-center items-center px-12">
                    <img src="{{ asset('storage/' . $supplier->logo)}}" class="w-auto h-full">
                  </div>
                </a>
                @endforeach
              </div>
              <div class="h-full flex flex-row justify-start items-center reviews-slide p-0">
                @foreach ($suppliers as $supplier)
                <a href="{{route('supplier',$supplier['id'])}}" class="p-none m-none">
                  <div class="reviews-slide-card w-[280px] h-[40px] flex justify-center items-center px-12">
                        <img src="{{ asset('storage/' . $supplier->logo)}}" class="w-auto h-full">
                  </div>
                </a>
                @endforeach
              </div>
            </div>
          </div>

        </div>
    </section>
