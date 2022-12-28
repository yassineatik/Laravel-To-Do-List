@extends('layouts.app')
@section('content')
    <div class="container">
        <center>
            <h2 class="wheat">Manage Your Tasks 💼</h2>
        </center>
        <hr>
        <div class="stats">
            <div class="Total_Tasks card bg-secondary">
                <h3>{{ $total_tasks }}</h3>
                <p>Total<br> Tasks</p>
            </div>
            <div class="Finished_Tasks card bg-success">
                <h3>{{ $tasks->count() }}</h3>
                <p>Finished <br> Tasks</p>
            </div>

            <div class="Unfinished_Tasks card">
                <h3>{{ $undone_tasks->count() }}</h3>
                <p>Remaining <br> Tasks</p>
            </div>
            <div class="pgorgress card bg-primary">
                @if ($total_tasks > 0)
                    <h3>{{ ($tasks->count() / $total_tasks) * 100 }}%</h3>
                @else
                    <h3>0%</h3>
                @endif

                {{-- <h3>{{ $total_tasks }}</h3> --}}
                <p>Progress</p>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="tables">
            <div class="addTasks">
                <h3>Add New Task ➕</h3>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <label for="taskName" class="form-label">Task Name</label>
                    <input type="text" name="name" id="taskName" placeholder="Task Name" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror
                    <label for="dueDate" class="form-label">Due Date</label>
                    <input type="date" name="due_date" id="dueDate" class="form-control" min="{{ date('Y-m-d') }}">
                    @error('due_date')
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="submit" name="add_task" value="Add Task" class="btn btn-secondary mt-2">
                </form>
            </div>


            @if ($undone_tasks->count() > 0)
                <div class="unfinished">
                    <H3>Unfinished Tasks ⌛ :</H3>
                    <table class="table-primary table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Task</th>
                                <th scope="col">Remaining Days</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($undone_tasks as $undone_task)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $undone_task->name }}</td>
                                    <td>
                                        @php
                                            $due_date = new DateTime($undone_task->due_date);
                                            $today = new DateTime(date('Y-m-d'));
                                            $remaining_days = $today->diff($due_date)->format('%a');
                                        @endphp
                                        {{ $remaining_days }}
                                    </td>
                                    <td>
                                        <form action="{{ route('tasks.update', $undone_task) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="is_done" value="1">
                                            <input type="submit" value="Mark As Done" class="btn btn-success">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('tasks.destroy', $undone_task) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="submit"><i
                                                    class="fas fa-trash primary"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            @endif
            @if ($tasks->count() > 0)
                <div class="finished">

                    <H3>Finished Tasks ✅ :</H3>
                    <table class="table-primary table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Task</th>
                                <th scope="col">Finished Day</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $task->name }}</td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($task->updated_at)) }}
                                    </td>
                                    <td>
                                        <form action="{{ route('tasks.update', ['task' => $task]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="is_done" value="0">
                                            <input type="submit" value="Undone" class="btn btn-secondary">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="submit"><i
                                                    class="fas fa-trash primary"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
@endsection

<style>
    body {
        /* padding: 0; */
        /* margin: 0; */
    }



    .tables {
        display: flex;
        justify-content: center;
        gap: 30px;
        height: 100hv;
        width: 100%;
        padding: 0;
    }

    .tasks {
        margin-top: 40px;

    }

    .table th,
    .table td {
        text-align: center;
    }

    .submit {
        background: none;
        border: none;
        margin-top: 7px;
        color: red;
    }

    .wheat {
        background-color: wheat;
    }

    .stats {
        display: flex;
        justify-content: center;
        gap: 100px;
        height: 140px;
        margin-bottom: 50px;
    }

    .card {
        width: 140px;
        height: 140px;
        background-color: red !important;
        display: flex;
        justify-content: center;
        border-radius: 30px;
    }

    .card h3,
    .card p {
        text-align: center;
        color: white;
        font-weight: 600;
        letter-spacing: 0.19rem
    }

    .card h3 {
        margin-top: 10px;
    }

    .box {
        position: relative;
        width: 300px;
        height: 400px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;

    }
</style>
