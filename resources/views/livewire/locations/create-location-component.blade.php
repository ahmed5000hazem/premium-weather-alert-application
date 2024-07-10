<div>
    <form wire:submit.prevent='create'>
        <h2 class="text-2xl">
            Add new location
        </h2>
        <div class="mt-8">
            <div class="relative flex items-center">
                <input name="name" type="text" wire:model='location.name' class="w-full bg-transparent text-sm border-b border-gray-300 focus:border-yellow-400 px-2 py-3 outline-none" placeholder="name" />
            </div>
            @error('location.name')
                <span class="text-sm text-red-500"> {{ $message }} </span>
            @enderror
        </div>
        
        <div class="grid grid-cols-2 gap-8 mt-8">
            <div>
                <div class="relative flex items-center">
                    <input name="longitude" type="text" wire:model='location.longitude' class="w-full bg-transparent text-sm border-b border-gray-300 focus:border-yellow-400 px-2 py-3 outline-none" placeholder="longitude" />
                </div>
                @error('location.longitude')
                    <span class="text-sm text-red-500"> {{ $message }} </span>
                @enderror
            </div>

            <div>
                <div class="relative flex items-center">
                    <input name="latitude" type="text" wire:model='location.latitude' class="w-full bg-transparent text-sm border-b border-gray-300 focus:border-yellow-400 px-2 py-3 outline-none" placeholder="latitude" />
                </div>
                @error('location.latitude')
                    <span class="text-sm text-red-500"> {{ $message }} </span>
                @enderror
            </div>
        </div>

        <button class="mt-8 w-max shadow-xl py-2 px-6 text-sm text-gray-800 font-semibold rounded-md bg-transparent bg-yellow-400 hover:bg-yellow-500 focus:outline-none">Add</button>
    </form>
</div>
