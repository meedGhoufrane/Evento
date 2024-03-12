@foreach ($events as $event)
    <div id="eventList" class="bg-white rounded-lg overflow-hidden shadow-md">
        <img src="{{ asset('image/valorant_3204973b.jpg') }}" class="w-full h-40 object-cover">
        <div class="p-4">
            <h2 class="text-xl font-semibold">{{ $event->title }}</h2>
            <div class="mt-2">
                <p class="text-gray-600 font-semibold">Categories:</p>

                <span
                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $event->categories->name }}</span>

            </div>
            <div class="mt-4 flex justify-between items-center">
                <a href="{{ route('event.show', $event->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded-md">View
                    Details</a>

            </div>
        </div>
    </div>
@endforeach
