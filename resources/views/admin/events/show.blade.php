<x-app-layout>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 w-96">
        <h1 class="text-3xl font-bold mb-4">Event Details</h1>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
            <p>{{ $event->title }}</p>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <p>{{ $event->description }}</p>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
            <p>{{ $event->location }}</p>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Seats</label>
            <p>{{ $event->seats }}</p>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
            <p>{{ $event->price }}</p>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
            <p>{{ $event->date }}</p>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
            <p>{{ $event->type }}</p>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
            <p>{{ $event->category->name }}</p>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
            <p>{{ $event->status }}</p>
        </div>
    </div>
</x-app-layout>
