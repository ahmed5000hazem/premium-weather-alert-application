<div class="flex justify-center">
    <div x-data="{ dropdownOpen: false }" class="relative">
        <button @click="dropdownOpen = !dropdownOpen" class="relative z-10 block rounded-md focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-gray-400 size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
            <span class="absolute text-white -top-2 -right-1 text-xs">{{ $notifications->count() }}</span>
        </button>

        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

        <div x-show="dropdownOpen" class="absolute h-64 overflow-auto right-0 mt-2 bg-white rounded-md shadow-lg z-20" style="width:20rem;">
            <div class="py-2">
                @forelse ($notifications as $notification)
                    <a href="#" class="block w-full px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                        <p class="text-gray-600 text-sm mx-2 font-bold text-center">
                            {{ $notification->data['title'] }}
                        </p>
                    </a>
                @empty
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-100 -mx-2">
                        <p class="text-gray-600 text-sm mx-2">
                            No new notifications
                        </p>
                    </a>
                @endforelse
            </div>
            @if ($notifications->isNotEmpty())
                <button wire:click='markAsRead' href="#" class="block w-full bg-gray-800 text-white text-center font-bold py-4">Mark all as read</button>
            @endif
        </div>
    </div>
</div>