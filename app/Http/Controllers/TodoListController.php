<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return view('welcome');
    }

    // Con Axios se debe crear un método para él
    public function getData(){
        $tareas = TodoList::all();

        return response()->json($tareas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $todoList = new TodoList;

        $todoList->title = $request->tarea[0]["title"];
        $todoList->content = $request->tarea[0]["content"];
        $todoList->completed = $request->tarea[0]["completed"];

        $todoList->save();

        return response()->json([
            'tarea' => $todoList,
            'message' => 'Success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function show(TodoList $todoList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function edit(TodoList $todoList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, TodoList $todoList)
    {
        //dd($request->all());

        $todoList->update($request->all());

        return response()->json([
            'tarea' => $todoList,
            'message' => 'Success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function destroy(TodoList $todoList)
    {
        $todoList->delete();
    }
}
