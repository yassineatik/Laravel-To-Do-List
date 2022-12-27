<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('tasks.index', ['tasks' => Task::all()->where('is_done', '=', '1'), 'undone_tasks' => Task::all()->where('is_done', '=', '0')]);
        return view('tasks.index')
            ->with('tasks', Task::all()->where('is_done', '=', '1')->where('user_id', '=', Auth::user()->id))
            ->with('undone_tasks', Task::all()->where('is_done', '=', '0')->where('user_id', '=', Auth::user()->id));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'due_date' => 'required',
        ]);
        Task::create($request->all());
        return redirect('/tasks')->with('status', 'task created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if ($task->is_done == 0) {
            $task->update(['is_done' => 1]);
            return to_route('tasks.index')->with('status', 'Task Done Successfully');
        } else if ($task->is_done == 1) {
            $task->update(['is_done' => 0]);
            return to_route('tasks.index')->with('status', 'Task UnDone');
        }
        // dd($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/tasks')->with('status', 'Task Deleted Successfully');
    }
}
