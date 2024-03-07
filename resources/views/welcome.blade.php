<x-index-layout>
    @include('includes.header')

    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background-image: url('{{ asset('image/valorant.webp') }}')"></div>
            <div class="swiper-slide" style="background-image: url('{{ asset('image/valorant_3204973b.jpg') }}')"></div>
            <div class="swiper-slide" style="background-image: url('{{ asset('image/kyledraws-vct-edited.jpg') }}')"></div>
        </div>
    </div>
    <div class="container mx-auto py-8">
        <!-- Search Input and Category Dropdown -->
        <div class="flex items-center justify-between mb-8">
            <!-- Search Input -->
            <div class="flex border border-gray-300 rounded-md">
                <input type="text" class="py-2 px-4 w-full" placeholder="Search events...">
                <button class="bg-blue-500 text-white rounded-l-none px-4 py-2">
                    <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                </button>
            </div>
            <!-- Category Dropdown -->
            <div class="relative">
                <select class="appearance-none border border-gray-300 rounded-md py-2 pl-4 pr-10">
                    <option value="" selected disabled>Select category</option>
                    <option value="category1">Category 1</option>
                    <option value="category2">Category 2</option>
                    <option value="category3">Category 3</option>
                    <!-- Add more categories here -->
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    <svg class="w-4 h-4 fill-current text-gray-600" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.293 7.707a1 1 0 0 1 1.414-1.414l3 3a1 1 0 0 1 0 1.414l-3 3a1 1 0 0 1-1.414-1.414L8.586 11H3a1 1 0 1 1 0-2h5.586L6.293 7.707z"/>
                    </svg>
                </div>
            </div>
        </div>

        <h1 class="text-3xl font-bold mb-4">All Events</h1>
        @if (auth()->user()->hasRole('organizer'))
        <button class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:bg-green-600 focus:outline-none mb-3">Create Event</button>
        @endif
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <!-- Loop through events and display each event card -->
            {{-- @foreach ($events as $event) --}}
            <div class="bg-white rounded-lg overflow-hidden shadow-md">
                <img src="{{ asset('image/valorant_3204973b.jpg') }}" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold"></h2>
                    <p class="text-gray-600 mt-2"></p>
                    <div class="mt-4 flex justify-between items-center">
                        <p class="text-gray-500"></p>
                        <button class="px-4 py-2 bg-blue-500 text-white rounded-md">View Details</button>
                    </div>
                </div>
            </div>
            {{-- @endforeach --}}
        </div>
    </div>

    

    @include('includes.footer')

</x-index-layout>
