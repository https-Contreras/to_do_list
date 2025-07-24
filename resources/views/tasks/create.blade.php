<x-app-layout>
    <div class="max-w-xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Crear nueva tarea</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-200 text-red-800 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-semibold" for="title">Título *</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="w-full border rounded px-3 py-2" />
            </div>

            <div>
                <label class="block mb-1 font-semibold" for="description">Descripción</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block mb-1 font-semibold" for="priority">Prioridad *</label>
                <select name="priority" id="priority" required class="w-full border rounded px-3 py-2">
                    <option value="baja" @selected(old('priority')=='baja')>Baja</option>
                    <option value="media" @selected(old('priority')=='media')>Media</option>
                    <option value="alta" @selected(old('priority')=='alta')>Alta</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold" for="due_date">Fecha límite</label>
                <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}"
                    class="w-full border rounded px-3 py-2" />
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Crear tarea
            </button>
        </form>
    </div>
</x-app-layout>