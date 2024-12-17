@extends('layouts.dashboard')

@section('content-dashboard')
    <section id="dashboard_history" class="bg-gray-light h-full w-full flex flex-row xl:gap-x-4 p-4 max-lg:overflow-y-scroll">

        <div class="w-full h-full flex flex-col justify-start items-start bg-gray-light rounded-xl gap-4">

            <div class="w-full h-full flex flex-col justify-stat items-start bg-white rounded-xl p-4">
                <div class="w-full h-auto flex flex-row justify-between py-4">
                    <div class="w-auto h-auto flex flex-row items-center gap-x-2">
                        <span class="h-8 w-8 bg-transparent flex items-center justify-center text-secondary-dark p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                        </span>
                        <h4 class="font-bold text-primary-dark capitalize">{{ __('messages.dashboard.home.active_orders') }}</h4>
                    </div>
                </div>

                <div id="order-cards-container" class="w-full h-full flex flex-col justify-start items-start overflow-y-scroll gap-y-4">

                    @foreach ($pagination->items() as $paginate)
                        <x-order-card :data="$paginate" type="history"/>
                    @endforeach
                </div>

                <div class="w-full h-auto flex flex-row justify-between mt-auto">
                    <div class="w-auto flex flex-row gap-x-1">
                        <a href="{{route('dashboard_history',['page' => 1 ] )}}" class="{{$pagination->currentPage() == 1 ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2 rounded-xl flex items-center justify-center   duration-300 cursor-pointer  p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m11 17-5-5 5-5"/><path d="m18 17-5-5 5-5"/></svg>
                        </a>

                        <a href="{{ route('dashboard_history', ['page' =>$pagination->currentPage() - 1]) }}" class="{{$pagination->currentPage() == 1 ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2  rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m15 18-6-6 6-6"/></svg>
                        </a>
                    </div>

                    <div class="w-auto flex flex-row gap-x-1">
                        <a href="{{ route('dashboard_history', ['page' =>$pagination->currentPage() + 1]) }}" class="{{$pagination->lastPage() == $pagination->currentPage() ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2  rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-full w-full"><path d="m9 18 6-6-6-6"/></svg>
                        </a>

                        <a href="{{ route('dashboard_history', ['page' =>$pagination->lastPage()]) }}" class="{{$pagination->lastPage() == $pagination->currentPage() ? 'bg-gray-100 text-gray-300 pointer-events-none' : 'hover:bg-secondary-dark hover:text-white border-secondary-dark active:scale-95 text-primary'}} h-10 w-10 border-2 rounded-xl flex items-center justify-center duration-300 cursor-pointer active:scale-95 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full"><path d="m6 17 5-5-5-5"/><path d="m13 17 5-5-5-5"/></svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <x-order-status-modal/>
    <x-order-custom-email-modal/>
@endsection
