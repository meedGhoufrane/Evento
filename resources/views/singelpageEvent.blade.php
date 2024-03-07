<x-index-layout>
    @include('includes.header')

    <body>
        <div class="container mx-auto mt-8">
            <div class="bg-white rounded-lg overflow-hidden shadow-md">
                <img src="{{ asset('image/valorant_3204973b.jpg') }}" class="w-full h-40 object-cover" alt="Event Image">
                <div class="p-4">
                    <h2 class="text-xl font-semibold">{{ $event->title }}</h2>
                    <p class="text-gray-600 mt-2">{{ $event->description }}</p>
                    <div class="mt-4 flex justify-between items-center">
                        <p class="text-gray-500">{{ $event->date }}</p>
                        <button class="px-4 py-2 bg-blue-500 text-white rounded-md">View Details</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    @include('includes.footer')

</x-index-layout>
