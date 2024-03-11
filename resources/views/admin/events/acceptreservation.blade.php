<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage reservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path fill-rule="evenodd"
                            d="M14.354 5.354a2 2 0 0 1 2.828 2.828l-9 9a2 2 0 0 1-2.828 0l-9-9a2 2 0 0 1 2.828-2.828L10 10.172l4.354-4.354z" />
                    </svg>
                </span>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="text-left p-3 px-5">ID</th>
                        <th class="text-left p-3 px-5">user id</th>
                        <th class="text-left p-3 px-5">event id</th>
                        <th class="text-left p-3 px-5">Update Status</th>
                        <th class="text-left p-3 px-5">reservation Status</th>

                    </tr>
                </thead>
                <tbody class="bg-gray-900 text-white divide-y divide-gray-700">
                    @foreach ($reservations as $reservation)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="p-3 px-5">{{ $reservation->id }}</td>
                            <td class="p-3 px-5">{{ $reservation->user_id }}</td>
                            <td class="p-3 px-5">{{ $reservation->event_id }}</td>
                            <td class="p-3 px-5">{{ $reservation->status }}</td>

                            <td class="p-3 px-5">
                                <form action="{{ route('events.updateStatusreservation', $reservation->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="px-4 py-2 border rounded-md bg-gray-800 text-white">
                                        <option value="pending" class="bg-gray-800">Pending</option>
                                        <option value="approved" class="bg-gray-800">Approved</option>
                                        <option value="rejected" class="bg-gray-800">Rejected</option>
                                    </select>
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:bg-blue-600 focus:outline-none">Update</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
