<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./task.css">
</head>

<body>

    <div class="container">
        <div class="tables">
            <table>
                <tr>
                    <td colspan="2">
                        <h3>Manage Your Tasks</h3>
                    </td>
                </tr>
                <tr>
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <td><input type="text" name="name" placeholder="Task Name"></td>
                        <td><input type="date" name="due_date" placeholder="Due Date" min="{{ date('Y-m-d') }}"></td>
                        <td><input type="submit" name="add_task" class="btn-submit" value="AddTask"></td>
                    </form>
                </tr>
            </table>
            <table class="tasks">
                <tr>
                    <th>Task</th>
                    <th>Days Remaining</th>
                    <th>Actions</th>
                </tr>
                @foreach ($tasks as $task)
                    @if ($task->is_done == 0)
                        <tr>
                            <td>{{ $task->name }}</td>
                            <td>
                                @php
                                    $due_date = new DateTime($task->due_date);
                                    $today = new DateTime(date('Y-m-d'));
                                    $remaining_days = $today->diff($due_date)->format('%a');
                                @endphp
                                {{ $remaining_days }}
                            </td>
                            <td>
                                <form action="{{ route('tasks.update', $task) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="is_done" value="1">
                                    <input type="submit" value="Mark As Done">
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
                <td><a href="{{ route('done_tasks') }}">View Done Tasks</a></td>
            </table>



        </div>
    </div>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-content: center;
        }

        .tasks {
            margin-top: 40px;
        }

        .tasks td {
            padding: 10px 30px;
        }
    </style>
</body>

</html>
