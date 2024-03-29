<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Events') }}
        </h2>
    </x-slot>

    <div class="py-12">

        @if (session('success'))
            <div id="alert-3"
                class=" lg:m-10 flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif




        <div class="relative overflow-x-auto lg:px-10">
            <div class="row  flex justify-start m-3 gap-3 ">
                <div class="col-lg-12 margin-tb w-40">
                    <div class="pull-right">
                        <a class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                            href="{{ route('events.create') }}">Create Event</a>
                    </div>
                </div>
{{-- 
                <div class="col-lg-12 margin-tb w-40">
                    <div class="pull-right">
                        <a class="block text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-700"
                            href="">Archived Events</a>
                        {{ route('events.archive') }}
                    </div>
                </div> --}}

            </div>
            @if ($events->count() > 0)
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Location
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Seats
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3">
                                type
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    {{ $event->id }}
                                </td>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $event->title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $event->description }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->location }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->seats }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->status }}
                                </td>
                                <td class="px-6 py-4">
                                    @foreach ($categories as $category)
                                        @if ($category->id === $event->category_id)
                                            {{ $category->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->type }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ url('events/' . $event->id . '/edit') }}"
                                        class="inline-block px-4 py-2 bg-blue-600 text-white font-medium rounded-md border border-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:border-blue-500 dark:hover:bg-blue-600 dark:text-white dark:hover:text-gray-100">
                                        Edit
                                    </a>
                                    <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-block px-4 py-2 bg-red-600 text-white font-medium rounded-md border border-red-600 hover:bg-red-700 dark:bg-red-500 dark:border-red-500 dark:hover:bg-red-600 dark:text-white dark:hover:text-gray-100">
                                            Delete
                                        </button>
                                    </form>
                                    {{-- {{ route('reservations.index', $event->id) }} --}}
                                  

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-9 p-3">
                    {{ $events->links() }}
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400 text-center mt-4">No events found.</p>
            @endif
        </div>
    </div>
</x-app-layout>
