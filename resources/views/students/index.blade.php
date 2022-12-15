@extends('layouts.bootstrap')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">phone</th>
                <th scope="col">actions</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <th scope="row">{{ $student->id }}</th>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>
                        <form action="{{ route('students.destroy', $student) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="Delete Student">
                        </form>
                    </td>
                    <td><a href="{{ route('students.edit', $student) }}">Edit Student</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('students.create') }}">Create New Student</a>
    @if (!empty($flash_message))
        @dd($flash_message)
    @endif
@endsection
