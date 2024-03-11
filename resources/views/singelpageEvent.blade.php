<x-index-layout>
    @include('includes.header')

    <div class="container mx-auto mt-8">
        <div class="bg-white rounded-lg overflow-hidden shadow-md">
            <img src="{{ asset('image/valorant_3204973b.jpg') }}" class="w-full h-40 object-cover" alt="Event Image">
            <div class="p-4">
                <h2 class="text-2xl font-semibold mb-4">{{ $event->title }}</h2>
                <p class="text-gray-600 mb-4">{{ $event->description }}</p>
                <div class="flex justify-between items-center">
                    <p class="text-gray-500">{{ $event->date }}</p>
                    <form action="{{ route('reservEvent') }}" method="POST">
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
    </div>

    @include('includes.footer')

</x-index-layout>
