<div>
    <section class="bg-gray-900 py-12 h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-white sm:text-5xl">
              Pricing Plans
            </h2>
            <p class="mt-4 text-xl text-gray-400">
              Simple, transparent pricing for your needs.
            </p>
          </div>
          
          <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
          @foreach ($products as $product)
            @foreach ($product['prices'] as $price)
              
            <div @class(['bg-gray-800 rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300', 'col-start-2' => $loop->index == 0])>
              <div class="mb-8">
                <h3 class="text-2xl font-semibold text-white">{{ $price->interval_name }}</h3>
                <p class="mt-4 text-gray-400">Get started with features for one {{ $price->interval }}.</p>
              </div>
              <div class="mb-8">
                <span class="text-5xl font-extrabold text-white">{{ $price->display_price }}</span>
                <span class="text-xl font-medium text-gray-400">/dolar</span>
              </div>
              <ul class="mb-8 space-y-4 text-gray-400">
                <li class="flex items-center">
                  <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  <span>Weather alerts and updates</span>
                </li>
                <li class="flex items-center">
                  <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  <span>Cancel any time</span>
                </li>
                <li class="flex items-center">
                  <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  <span>7-day free trial for new users</span>
                </li>
              </ul>
              @if (!auth()->user()->subscribed($product['id']))
              <button wire:click="checkout('{{ $product['id'] }}', '{{ $price->id }}')" class="block cursor-pointer w-full py-3 px-6 text-center rounded-md text-white font-medium bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600">
                Checkout
              </button>
              @endif
            </div>


            @endforeach
            @endforeach
          </div>
      </section>
</div>
