<section id="suppliers" class="w-full h-auto bg-white text-body">
    <div class="relative w-full h-full padding flex flex-col justify-center items-center">
        <h5 class="animation-element slide-in-up">{{$header}}</h5>
        <h1 class="font-bold text-primary-dark animation-element slide-in-up text-center">
            {{$title}}
        </h1>

        <div class="h-full w-full grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 xl:gap-24 py-12 xl:p-12 animation-group">

            @if(!empty($suppliers) && isset($suppliers[0]))
                @foreach ($suppliers as $supplier)
                    <div class="col-span-1 flex flex-col justify-start items-start h-[400px] animation-element slide-in-left">
                        <div class="w-full min-h-[200px] flex justify-center items-center p-4">
                            <img src="{{ $supplier['logo'] }}" class="w-auto h-16"/>
                        </div>
                        <a href="{{route('supplier', $supplier['id'])}}" class="group p-none m-none">
                            <span class="font-bold text-primary group-hover:underline">{{$supplier['name']}}</span>
                        </a>
                        <div class="w-full h-full p-6">
                            <ul class="list-disc">
                                @foreach($supplier['details'] as $detail)
                                    <li><p>{{$detail}}</p></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-1 sm:col-span-2 xl:col-span-3 flex flex-col items-center justify-center py-24 gap-y-12">
                    <h5 class="font-bold text-primary">Currently no Products for this Supplier</h5>
                    <img src="/images/svg/empty.svg" class="h-48 w-auto"/>
                </div>
            @endif
        </div>
    </div>
</section>
