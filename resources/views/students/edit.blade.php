<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PATCH')
        Name : <input type="text" name="name" id="" value="{{ $student->name }}"><br>
        email : <input type="email" name="email" id="" value="{{ $student->email }}"><br>
        phone : <input type="text" name="phone" id="" value="{{ $student->phone }}"><br>
        <input type="submit" value="Update Student">
    </form>
</body>

</html>
