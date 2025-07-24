<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|max:255',
        'description' => 'nullable|string',
        'priority' => 'required|in:baja,media,alta',
        'due_date' => 'nullable|date',
        ]);
        auth()->user()->tasks()->create($request->only(['title', 'description', 'priority', 'due_date']));
        return redirect()->route('tasks.index')->with('succes', 'Tarea creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
            
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' =>'required|date',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
          // Verificar que la tarea pertenezca al usuario autenticado
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada correctamente.');
    }

    public function toggle(Task $task)
        {
            // Asegúrate de que solo el dueño de la tarea pueda actualizarla
            if ($task->user_id !== auth()->id()) {
                abort(403);
            }

            $task->update([
                'is_completed' => !$task->is_completed
            ]);

            return redirect()->route('tasks.index');
        }

}
