<div>
    @forelse ($locations as $location)
    <div class="rounded-lg px-8 py-4 bg-gray-900 text-white mb-4">
        <div class="flex justify-between items-center ">
            <span class="text-yellow-400 text-2xl capitalize">
                {{ $location->name }}
            </span>
            <div class="flex">
                <button wire:click='obtainWeather({{ $location->id }})' class="rounded-full p-1 focus:bg-sky-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 0 0 4.5 4.5H18a3.75 3.75 0 0 0 1.332-7.257 3 3 0 0 0-3.758-3.848 5.25 5.25 0 0 0-10.233 2.33A4.502 4.502 0 0 0 2.25 15Z" />
                    </svg>
                </button>
                <button wire:click='delete({{ $location->id }})' class="rounded-full bg-red-700 p-1 ms-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="mt-4">
            <span>
                <b>Lng</b> {{ $location->longitude }}
            </span>
            <span class="ms-4">
                <b>Lat</b> {{ $location->latitude }}
            </span>
        </div>
    </div>
    @empty
        <div class="text-center rounded-lg p-8 bg-gray-900 text-white">
            No locations found. Please add a location.
        </div>
    @endforelse
</div>
