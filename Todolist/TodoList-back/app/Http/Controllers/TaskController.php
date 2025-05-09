<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return new TaskResource(Task::all());
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();

        Task::create($validated);

        return new TaskResource($validated);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {

        $validated = $request->validated();

        $task->update($validated);

        return new TaskResource($task);
    }

    public function destroy(Request $request, Task $task)
    {
        $task->delete();

        return response()->json([
           'message'=>'Task succesfully deleted!',
        ]);
    }
}
