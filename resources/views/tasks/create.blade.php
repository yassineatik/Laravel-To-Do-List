<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Task</title>
</head>

<body>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        Task Title <input type="text" name="title" id="" placeholder="Task Title"><br>
        Task Description <input type="text" name="description" placeholder="Task Description" id=""><br>
        <input type="hidden" name="is_done" value="no" id="">
        <input type="submit" value="Save Task">
    </form>
</body>

</html>
