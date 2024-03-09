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
            <form action="{{ route('searchByTitle') }}" method="GET">
                <div class="flex border border-gray-300 rounded-md">
                    <input type="text" name="search_query" class="py-2 px-4 w-full" placeholder="Search events...">
                    <button type="submit" class="bg-blue-500 text-white rounded-l-none px-4 py-2">
                        <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                        </svg>
                    </button>
                </div>
            </form>
            <!-- Category Dropdown -->
            {{-- <form action="{{ route('searchByCategory') }}" method="POST">
                @csrf
                <div class="relative">
                    <select name="category_id" class="appearance-none border border-gray-300 rounded-md py-2 pl-4 pr-10">
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
                <button type="submit" class="bg-blue-500 text-white rounded-l-none px-4 py-2">
                    Search
                </button>
            </form> --}}



        </div>

        <h1 class="text-3xl font-bold mb-4">All Events</h1>
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
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <img src="{{ asset('image/valorant_3204973b.jpg') }}" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold">{{ $event->title }}</h2>
                        <p class="text-gray-600 mt-2">{{ $event->description }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <p class="text-gray-500">{{ $event->date }}</p>
                            <a href="{{ route('events.show', $event->id) }}"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md">View Details</a>

                            <form action="{{route('reservEvent')}}" method="POST">
                                @csrf
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Reserve
                                </button>
                            </form>

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

    {{-- <script>
        $(document).ready(function() {
            var currentPage = 1;
            var eventsPerPage = 6;
            var totalEvents = {!! json_encode($events->count()) !!};
            var totalPages = Math.ceil(totalEvents / eventsPerPage);
            var eventsData = {!! json_encode($events) !!};

            loadEvents(currentPage);

            function loadEvents(page) {
                var startIndex = (page - 1) * eventsPerPage;
                var endIndex = startIndex + eventsPerPage;
                var eventsOnPage = eventsData.slice(startIndex, endIndex);

                $('#eventsContainer').empty();

                eventsOnPage.forEach(function(event) {
                    var eventCard = `
                        <div class="bg-white rounded-lg overflow-hidden shadow-md">
                            <img src="${event.image}" class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h2 class="text-xl font-semibold">${event.title}</h2>
                                <p class="text-gray-600 mt-2">${event.description}</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <p class="text-gray-500">${event.date}</p>
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md">View Details</button>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#eventsContainer').append(eventCard);
                });
            }

            $('#prevPageBtn').click(function() {
                if (currentPage > 1) {
                    currentPage--;
                    loadEvents(currentPage);
                    $('#nextPageBtn').prop('disabled', false);
                    if (currentPage === 1) {
                        $(this).prop('disabled', true);
                    }
                }
            });

            $('#nextPageBtn').click(function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    loadEvents(currentPage);
                    $('#prevPageBtn').prop('disabled', false);
                    if (currentPage === totalPages) {
                        $(this).prop('disabled', true);
                    }
                }
            });
        });
    </script> --}}

</x-index-layout>
