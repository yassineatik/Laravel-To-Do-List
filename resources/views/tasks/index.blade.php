<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./task.css">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>


    <div class="container">
        <div class="tables">
            <div class="addTasks">
                <form action="{{ route('tasks.store') }}" method="POST">
                    <h3>Manage Your Tasks 💼</h3>
                    @csrf
                    <label for="taskName" class="form-label">Task Name</label>
                    <input type="text" name="name" id="taskName" placeholder="Task Name" class="form-control">
                    <label for="dueDate" class="form-label">Due Date</label>
                    <input type="date" name="due_date" id="dueDate" class="form-control" min="{{ date('Y-m-d') }}">
                    <input type="submit" name="add_task" value="Add Task" class="btn btn-secondary mt-2">
                </form>
            </div>

            <div class="unfinished">

                <H2>Unfinished Tasks ⌛ :</H2>
                <table class="table-primary table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Task</th>
                            <th scope="col">Remaining Days</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($undone_tasks as $undone_task)
                            <tr>
                                <th scope="row">{{ $undone_task->id }}</th>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="finished">

                <H2>Finished Tasks ✅ :</H2>
                <table class="table-success table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Task</th>
                            <th scope="col">Finished Day</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <th scope="row">{{ $task->id }}</th>
                                <td>{{ $task->name }}</td>
                                <td>
                                    {{ date('d-m-Y', strtotime($task->updated_at)) }}
                                </td>
                                <td>
                                    <form action="{{ route('tasks.update', ['task' => $task]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="is_done" value="0">
                                        <input type="submit" value="Undone" class="btn btn-primary">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
    <style>
        body {
            /* background-color: rgb(76, 71, 71); */
            /* color: white; */
            padding: 0;
            margin: 0;
        }

        .tables {
            display: flex;
            justify-content: space-between;
            height: 100hv;
        }

        .tasks {
            margin-top: 40px;
        }

        .table th,
        .table td {
            /* padding: 10px 30px; */
            /* color: white; */
            text-align: center;
        }
    </style>
</body>

</html>
