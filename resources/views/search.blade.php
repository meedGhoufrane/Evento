@foreach ($events as $event)
<div id="eventList" class="bg-white rounded-lg overflow-hidden shadow-md">
    <img src="{{ asset('image/valorant_3204973b.jpg') }}" class="w-full h-40 object-cover">
    <div class="p-4">
        <h2 class="text-xl font-semibold">{{ $event->title }}</h2>
        <p class="text-gray-600 mt-2">{{ $event->description }}</p>
        <div class="mt-4 flex justify-between items-center">
            <p class="text-gray-500">{{ $event->date }}</p>
            <a href="{{ route('events.show', $event->id) }}"
                class="px-4 py-2 bg-blue-500 text-white rounded-md">View Details</a>

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
@endforeach