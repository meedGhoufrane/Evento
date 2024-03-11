<x-index-layout>
    @include('includes.header')



    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background-image: url('{{ asset('image/valorant.webp') }}')"></div>
            <div class="swiper-slide" style="background-image: url('{{ asset('image/valorant_3204973b.jpg') }}')"></div>
            <div class="swiper-slide" style="background-image: url('{{ asset('image/kyledraws-vct-edited.jpg') }}')">
            </div>
        </div>
    </div>
    <div class="container mx-auto py-8">
        <!-- Search Input and Category Dropdown -->
        <div class="flex items-center justify-between mb-8">
            <!-- Search Input -->
            <form id="searchForm" action="{{ route('searchByTitle') }}" method="GET">
                <div class="flex border border-gray-300 rounded-md">
                    <input type="text" name="search_query" id="searchQuery" class="py-2 px-4 w-full"
                        placeholder="Search events...">
                    <button type="submit" class="bg-blue-500 text-white rounded-l-none px-4 py-2">
                        <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                        </svg>
                    </button>
                </div>
            </form>


            <form id="searchByCategoryForm">
                @csrf
                <div class="relative">
                    <button type="button" id="searchButton" class="bg-blue-500 text-white rounded-l-none px-4 py-2">
                        Search
                    </button>
                    <select name="category_id" id="categoryId"
                        class="appearance-none border border-gray-300 rounded-md py-2 pl-4 pr-10">
                        <option value="" selected disabled>Select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <svg class="w-4 h-4 fill-current text-gray-600" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.293 7.707a1 1 0 0 1 1.414-1.414l3 3a1 1 0 0 1 0 1.414l-3 3a1 1 0 0 1-1.414-1.414L8.586 11H3a1 1 0 1 1 0-2h5.586L6.293 7.707z" />
                        </svg>
                    </div>
                </div>
            </form>





        </div>

        <h1 class="text-3xl font-bold mb-4">All Events</h1>

        {{-- @if ($errors->any())

            <div id="alert-2"
                class="lg:m-10   flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif --}}
        {{-- @if ($noEventsFound)
            <p class="text-red-500 font-semibold">No events found Try search for events </p>
        @else --}}
        @if (auth()->check() && auth()->user()->hasRole('organizer'))
            <a href="{{ route('events.create') }}"
                class="inline-block px-3 py-1 bg-green-500 text-white rounded-md hover:bg-green-600 focus:bg-green-600 focus:outline-none mb-3 text-sm">Create
                Event</a>
        @endif
        <div id="eventsContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <!-- Loop through events and display each event card -->

            @foreach ($events as $event)
                <div id="eventList" class="bg-white rounded-lg overflow-hidden shadow-md">
                    <img src="{{ asset('image/valorant_3204973b.jpg') }}" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold">{{ $event->title }}</h2>
                        <div class="mt-2">
                            <p class="text-gray-600 font-semibold">Categories:</p>
                            @if ($event->categories)
                                @foreach ($event->categories as $category)
                                    <span
                                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $category->name }}</span>
                                @endforeach
                            @else
                                <span class="text-gray-600">No categories</span>
                            @endif
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('event.show', $event->id) }}"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md">View Details</a>


                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        {{-- @endif --}}

        {{-- <div id="paginationControls">
            <button id="prevPageBtn" class="px-4 py-2 bg-blue-500 text-white rounded-md mr-2" disabled>Previous</button>
            <button id="nextPageBtn" class="px-4 py-2 bg-blue-500 text-white rounded-md">Next</button>
        </div> --}}


        <div class="pagination">
            {{ $events->links() }}
        </div>

    </div>


    @include('includes.footer')


    <script>
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            let searchQuery = document.getElementById('searchQuery').value;

            // Make AJAX request
            fetch('{{ route('searchByTitle') }}?search_query=' + encodeURIComponent(searchQuery))
                .then(response => response.text())
                .then(html => {
                    document.getElementById('eventsContainer').innerHTML =
                        html; // Update the content of the event list
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

</x-index-layout>
