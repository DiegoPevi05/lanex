<div class="w-full h-auto flex flex-col">
    <!-- Tabs -->
    <div class="w-auto flex flex-row justify-start rounded-t-lg">
        <!-- Tab 1 -->
        <div class="cursor-pointer py-3 px-6 rounded-tl-lg text-primary-dark bg-white {{ $activeTab === 'tab1' ? ' font-bold' : '' }} group" 
             wire:click="setActiveTab('tab1')">
             <label class="font-bold group-hover:cursor-pointer">Tracking</label>
        </div>
        <!-- Tab 2 -->
        <div class="cursor-pointer py-3 px-6 rounded-tr-lg bg-primary-dark {{ $activeTab === 'tab2' ? 'font-bold' : '' }} group" 
             wire:click="setActiveTab('tab2') ">
             <label class="font-bold group-hover:cursor-pointer">Cotizar</label>
        </div>
    </div>

    <!-- Tab Content -->
    <div class="w-full sm:w-96 md:w-[500px] flex shadow-md rounded-b-lg rounded-tr-lg p-4
        {{ $activeTab === 'tab1' ? ' bg-white' : 'bg-primary-dark' }}
        ">
        @if($activeTab === 'tab1')
            <!-- Content for Tab 1 -->
            <div class="w-full h-auto flex flex-col items-start justify-start text-body gap-y-1">
                <div class="w-full flex flex-col sm:flex-row items-end sm:items-center justify-start gap-y-4 sm:gap-x-4">
                    <input placeholder="Tracking ID" class="uppercase w-full border-2 border-body rounded-md p-4 text-md font-bold focus:border-2 focus:border-primary focus:outline-none" />
                    <livewire:button-link text="Buscar" url="#" extraClasses="h-full uppercase font-bold"/>
                </div>
                <p class="text-[12px]">This is the content for Tab 1. It can be anything you want. <a class="text-primary underline cursor-pointer">Help</a></p>
            </div>
        @elseif($activeTab === 'tab2')
            <!-- Content for Tab 2 -->
            <div class="w-full h-auto flex flex-col items-start justify-start text-white gap-y-1">
                <div class="w-full flex flex-col sm:flex-row items-end sm:items-center justify-start gap-y-4 sm:gap-x-4">
                    <input placeholder="Nombre del Producto" class="uppercase w-full border-2 border-body rounded-md p-4 text-md font-bold" />
                    <livewire:button-link text="Cotizar" variant="secondary" url="#" extraClasses="h-full uppercase font-bold"/>
                </div>
                <p class="text-[12px]">This is the content for Tab 1. It can be anything you want. <a class="underline cursor-pointer">Help</a></p>
            </div>
        @endif
    </div>
</div>
