<div
    class="card border-gray-100 bg-gray-900 transition-shadow test shadow-lg hover:shadow-shadow-xl w-full text-purple-50 rounded-md">
    @if ($errorMessage)
        <div class="p-32">
            {{ $errorMessage }}
        </div>
    @else
        <h2 class="text-md mb-2 px-4 pt-4">
            <div class="flex justify-between">
                <div class="badge relative top-0">
                    <span class="mt-2 py-1 h-12px text-md font-semibold w-12px  rounded right-1 bottom-1 px-4 text-yellow-400">{{ $weather->location->name }}</span></div>
                <div>
                    <span class="text-sm"> last updated {{ Carbon\Carbon::parse(optional($weather->current)->last_updated_epoch)->format('H:i') }} </span>
                </div>
                <span class="text-lg font-bold ">{{ Carbon\Carbon::now()->format('H:i') }}</span>
            </div>
        </h2>

        <div class="flex justify-center items-center p-4 mt-4">
            <img class="w-32" src="{{ optional($weather->current)->condition->icon }}" alt="">
        </div>
        <div class="text-md pt-4 pb-4 px-4">
            <div class="flex justify-between items-center">
                <div class="space-y-2">
                    <span class="flex space-x-2 items-center text-yellow-400">
                        <span>
                            {{ optional($weather->current)->condition->text }}
                        </span>
                    </span>
                    <span class="flex space-x-2 items-center">
                        <svg height="20" width="20" viewBox="0 0 32 32" class="fill-current">
                            <path d="M13,30a5.0057,5.0057,0,0,1-5-5h2a3,3,0,1,0,3-3H4V20h9a5,5,0,0,1,0,10Z"></path>
                            <path d="M25 25a5.0057 5.0057 0 01-5-5h2a3 3 0 103-3H2V15H25a5 5 0 010 10zM21 12H6V10H21a3 3 0 10-3-3H16a5 5 0 115 5z"></path>
                        </svg>
                        <span>
                            {{ optional($weather->current)->wind_kph }} km/h
                        </span>
                    </span>
                    <span class="flex space-x-2 items-center">
                        <svg height="20" width="20" viewBox="0 0 32 32" class="fill-current">
                            <path d="M16,24V22a3.2965,3.2965,0,0,0,3-3h2A5.2668,5.2668,0,0,1,16,24Z"></path>
                            <path d="M16,28a9.0114,9.0114,0,0,1-9-9,9.9843,9.9843,0,0,1,1.4941-4.9554L15.1528,3.4367a1.04,1.04,0,0,1,1.6944,0l6.6289,10.5564A10.0633,10.0633,0,0,1,25,19,9.0114,9.0114,0,0,1,16,28ZM16,5.8483l-5.7817,9.2079A7.9771,7.9771,0,0,0,9,19a7,7,0,0,0,14,0,8.0615,8.0615,0,0,0-1.248-3.9953Z"></path>
                        </svg>
                        <span>{{ optional($weather->current)->humidity }} %</span>
                    </span>
                </div>
                <div>
                    <p class="text-6xl text-yellow-400"> {{ optional($weather->current)->temp_c }}° </p>
                    @if (optional($weather->forecast->forecastday)[0])
                        <p class="text-xs text-center mt-1 text-gray-200">
                            <span class="font-bold"> Next hour </span>
                            {{ optional($weather->forecast->forecastday[0]->hour)[0]->temp_c }}°
                            {{ optional($weather->forecast->forecastday[0]->hour)[0]->condition->text }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
