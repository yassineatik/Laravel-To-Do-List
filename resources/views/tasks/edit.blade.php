<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('tasks.update', ['task' => $task]) }}" method="POST">
        @csrf
        @method('PATCH')
        Task Title <input type="text" name="title" value="{{ $task->title }}"><br>
        Task Description <input type="text" name="description" value="{{ $task->description }}"><br>
        Is Done ?
        <select name="is_done" id="">
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select><br>
        <input type="submit" value="Save Task">
    </form>
</body>

</html>
