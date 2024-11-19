<section id="suppliers" class="w-full h-auto bg-white text-body">
    <div class="relative w-full h-full padding flex flex-col justify-center items-center">
        <h5 class="animation-element slide-in-up">{{$header}}</h5>
        <h1 class="font-bold text-primary-dark animation-element slide-in-up text-center">
            {{$title}}
        </h1>

        <div class="h-full w-full grid grid-cols-3 sm:grid-cols-4 xl:grid-cols-3 gap-6 xl:gap-24 py-12 xl:p-12 animation-group">

            @if(!empty($suppliers) && isset($suppliers[0]))
                @foreach ($suppliers as $supplier)
                    <div class="col-span-3 sm:col-span-2 xl:col-span-1 flex flex-col justify-start items-start h-auto animation-element slide-in-left">
                        <div class="w-full min-h-[200px] flex justify-center items-center p-4">
                            <img src="{{ asset('storage/' . $supplier['logo']) }}" class="w-auto h-16"/>
                        </div>
                        <a href="{{route( 'supplier', $supplier['id'])}}" class="group p-none m-none">
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
<div class="col-span-3 sm:col-span-4 xl:col-span-3 flex flex-row justify-around">
    <div class="flex flex-row w-auto h-auto justify-center items-center gap-x-4">
        <!-- First Page -->
        <a href="{{ route($parentUrl, array_merge(['page_suppliers' => 1], $parentUrl === 'supplier' ? ['id' => $parentUrlId] : [])) }}"
           class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white
           {{ Request::query('page_suppliers', 1) == 1 ? 'bg-gray-300 pointer-events-none border-gray-200 text-gray-200' : ' text-white bg-primary hover:bg-white hover:text-primary border-primary' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-left">
                <path d="m11 17-5-5 5-5"></path><path d="m18 17-5-5 5-5"></path>
            </svg>
        </a>
        <!-- Previous Page -->
        <a href="{{ route($parentUrl, array_merge(['page_suppliers' => max(1, $suppliers->currentPage() - 1)] ,$parentUrl === 'supplier' ? ['id' => $parentUrlId] : [])) }}"
           class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white
           {{ Request::query('page_suppliers', 1) == 1 ? 'bg-gray-300 pointer-events-none border-gray-200 text-gray-200' : ' text-white bg-primary hover:bg-white hover:text-primary border-primary' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left">
                <path d="m15 18-6-6 6-6"></path>
            </svg>
        </a>
    </div>
    <div class="flex flex-row w-auto h-auto justify-center items-center gap-x-4">
        <!-- Next Page -->
        <a href="{{ route($parentUrl, array_merge(['page_suppliers' => min($suppliers->lastPage(), $suppliers->currentPage() + 1)],$parentUrl === 'supplier' ? ['id' => $parentUrlId] : []) ) }}"
           class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white
           {{ $suppliers->lastPage() == $suppliers->currentPage()   ? 'bg-gray-300 pointer-events-none border-gray-200 text-gray-200' : ' text-white bg-primary hover:bg-white hover:text-primary border-primary' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
        </a>
        <!-- Last Page -->
        <a href="{{ route($parentUrl, array_merge(['page_suppliers' => $suppliers->lastPage()],$parentUrl === 'supplier' ? ['id' => $parentUrlId] : [])) }}"
           class="h-8 sm:h-12 w-8 sm:w-12 max-sm:p-1 rounded-full inline-flex justify-center items-center  duration-300 active:scale-95 border-2 shadow-lg active:border-white
           {{ $suppliers->lastPage() == $suppliers->currentPage()   ? 'bg-gray-300 pointer-events-none border-gray-200 text-gray-200' : ' text-white bg-primary hover:bg-white hover:text-primary border-primary' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-right">
                <path d="m6 17 5-5-5-5"></path><path d="m13 17 5-5-5-5"></path>
            </svg>
        </a>
    </div>
</div>
            @else
                <div class="col-span-1 sm:col-span-2 xl:col-span-3 flex flex-col items-center justify-center py-24 gap-y-12">
                    <h5 class="font-bold text-primary">Currently no Products for this Supplier</h5>
                    <img src="{{ asset('storage/' . '/images/web/empty.svg' ) }}" class="h-48 w-auto"/>
                </div>
            @endif
        </div>
    </div>
</section>
