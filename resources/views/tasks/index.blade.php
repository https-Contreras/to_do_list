<x-app-layout>

<div class="max-w-2xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Mis Tareas</h1>

    <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
        + Nueva Tarea
    </a>

    @if($tasks->isEmpty())
        <p>No tienes tareas aún.</p>
    @else
        <ul class="space-y-4">
            @foreach($tasks as $task)
                <li class="border p-3 rounded @if($task->is_completed) bg-green-100 @endif">
                    <h2 class="text-lg font-semibold">
                        {{ $task->title }}
                        @if($task->is_completed)
                            <span class="text-green-600 text-sm">(completada)</span>
                        @endif
                    </h2>
                    <p>{{ $task->description }}</p>
                    <p class="text-sm text-gray-500">Prioridad: {{ ucfirst($task->priority) }} | Fecha límite: {{ $task->due_date ?? '—' }}</p>

                    <div class="mt-2">
                        <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600">Editar</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 ml-2" onclick="return confirm('¿Eliminar tarea?')">Eliminar</button>
                        </form>


                        <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-2 py-1 rounded 
                                {{ $task->is_completed ? 'bg-gray-500 hover:bg-gray-600' : 'bg-green-600 hover:bg-green-700' }} 
                                text-white">
                                {{ $task->is_completed ? 'Desmarcar' : 'Marcar como hecha' }}
                            </button>
                        </form>   
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

</div>

</x-app-layout>