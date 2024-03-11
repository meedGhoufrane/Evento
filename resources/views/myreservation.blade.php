<x-index-layout>

    @include('includes.header')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="text-2xl">
                        My Reservations
                    </div>
                    <div class="mt-6 text-gray-500">
                        <table class="min-w-full bg-white border border-gray-200 rounded-md">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">Event Title</th>
                                    <th class="py-2 px-4 border-b">User Name</th>
                                    <th class="py-2 px-4 border-b">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $reservation->event->title }}</td>
                                        <td class="py-2 px-4 border-b">{{ $reservation->user->name }}</td>
                                        <td class="py-2 px-4 border-b">{{ $reservation->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer')

</x-index-layout>
