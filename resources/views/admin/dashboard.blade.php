<x-app-layout>
    <div class="bg-gray-900 text-white">
        <!-- Statistics for Events, Categories, and Users -->
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <!-- Event Statistics -->
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-md flex items-center justify-center">
                    <div class="p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-yellow-400 mb-4" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 2a1 1 0 00-1 1v1.586L5.707 6.793a1 1 0 00-.293.707v8a1 1 0 001 1h2a1 1 0 001-1v-6h2v6a1 1 0 001 1h2a1 1 0 001-1v-8a1 1 0 00-.293-.707L14 4.586V3a1 1 0 00-1-1h-2zM8 13v4H7v-4H4v-2h3V7h1v4h3v2H8z"
                                clip-rule="evenodd" />
                        </svg>
                        <h2 class="text-xl font-semibold mb-4">Events</h2>
                        <p class="text-3xl font-bold">{{ $eventCount }}</p>
                    </div>
                </div>

                @if (auth()->user()->hasRole('admin'))
                    <!-- Category Statistics -->
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-md flex items-center justify-center">
                        <div class="p-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-400 mb-4"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M14 3H6a2 2 0 00-2 2v12l5-3 5 3V5a2 2 0 00-2-2z"
                                    clip-rule="evenodd" />
                            </svg>
                            <h2 class="text-xl font-semibold mb-4">Categories</h2>
                            <p class="text-3xl font-bold">{{ $categoryCount }}</p>
                        </div>
                    </div>

                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-md flex items-center justify-center">
                        <div class="p-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-400 mb-4"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 2a1 1 0 00-1 1v1.586L5.707 6.793a1 1 0 00-.293.707v8a1 1 0 001 1h2a1 1 0 001-1v-6h2v6a1 1 0 001 1h2a1 1 0 001-1v-8a1 1 0 00-.293-.707L14 4.586V3a1 1 0 00-1-1h-2zM8 13v4H7v-4H4v-2h3V7h1v4h3v2H8z"
                                    clip-rule="evenodd" />
                            </svg>
                            <h2 class="text-xl font-semibold mb-4">Users</h2>
                            <p class="text-3xl font-bold">{{ $userCount }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
