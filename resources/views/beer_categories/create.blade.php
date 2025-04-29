<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">Crear Categoría</h1>
        <form action="{{ route('beer_categories.store') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label class="block font-bold text-gray-700 dark:text-gray-300">Nombre:</label>
                <input type="text" name="name" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100" required>
            </div>
            <div class="mb-4">
                <label class="block font-bold text-gray-700 dark:text-gray-300">Descripción:</label>
                <textarea name="description" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100"></textarea>
            </div>
            <button type="submit" class="bg-[#F7A034] hover:bg-[#D26329] text-white px-4 py-2 rounded-lg">Guardar</button>
        </form>
    </div>
</x-app-layout>
