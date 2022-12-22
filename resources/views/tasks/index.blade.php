<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tasks | Home</title>
</head>

<body>
    <H1>Tasks</H1>
    @if (count($tasks) > 0)
        <table border="1">
            <tr>
                <th>N°</th>
                <th>Title</th>
                <th>Description</th>
                <th>Is Done ?</th>
                <th>Actions</th>
            </tr>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->is_done }}</td>
                    <td>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                    <td><a href="{{ route('tasks.edit', $task) }}"><button>Update</button></a></td>
                </tr>
            @endforeach
    @endif
    </table>
</body>

</html>
