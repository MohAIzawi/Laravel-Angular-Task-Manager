<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\ReadTaskRequest;
use App\Http\Requests\Tasks\StoreTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Http\Requests\Tasks\WriteTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

// Généré avec la commande : php artisan make:controller TasksController --api
class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'nullable|string|max:2000',
            'dueDate' => 'nullable|date',
            'assignedTo' => 'nullable|string|max:250',
        ]);
        
        $task = Task::create($validated);
        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Task $task): JsonResponse
    {
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'nullable|string|max:2000',
            'dueDate' => 'nullable|date',
            'assignedTo' => 'nullable|string|max:250',
        ]);
        
        $task->update($validated);
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WriteTaskRequest $request, Task $task): JsonResponse
    {
        $task->delete();
        return response()->json(null, 204);
    }
}