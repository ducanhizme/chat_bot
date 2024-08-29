<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateToDoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class TodoController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(TodoResource::collection(Todo::all()), "Todos retrieved successfully", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateToDoRequest $request)
    {

        try {
            $validated = $request->validated();
            $todo = new Todo();
            $todo->title = $validated['title'];
            $todo->description = $validated['description'];
            $todo->status_id = $validated['status_id'];
            $todo->user_id = $request->user()->id;
            $todo->save();
            return $this->sendResponse(new TodoResource($todo), "Todo created successfully", 201);
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e->getMessage(), "Can't create todo", 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return $this->sendResponse($todo, "Todo retrieved successfully", 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $validated = $request->validated();
        $todo->title = $validated['title'];
        $todo->description = $validated['description'];
        $todo->status_id = $validated['status_id'];
        $todo->save();
        return $this->sendResponse(new TodoResource($todo), "Todo updated successfully", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        Gate::authorize('delete', $todo);
        $todo->delete();
    }
}
