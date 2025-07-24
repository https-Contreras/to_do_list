<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Editar Tarea
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-6 p-4 bg-white shadow-md rounded">
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Título</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $task->title) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Descripción</label>
                <textarea
                    name="description"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    rows="4"
                >{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Fecha límite</label>
                <input
                    type="date"
                    name="due_date"
                    value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                >
            </div>

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            >
                Actualizar Tarea
            </button>
        </form>
    </div>
</x-app-layout>
