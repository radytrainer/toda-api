<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Todo::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:100',
            'description' => 'nullable|min:3|max:500',
        ]);
        $todo = new Todo();
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->user_id = $request->user_id; // TODO: after
        $todo->save();

        return response()->json(['message' => 'created', 'data' => $todo], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        return Todo::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3|max:100',
            'description' => 'nullable|min:3|max:500',
        ]);
        $todo = Todo::findOrFail($id);
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->user_id = $request->user_id; // TODO: after
        $todo->save();

        return response()->json(['message' => 'updated', 'data' => $todo], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::destroy($id);
        if ($todo == 1) {
            return response()->json(['message'=> 'deleted'], 200);
        }else {
            return response()->json(['message'=> 'ID Not found'], 404);
        }
    }
}
