{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <form action="{{ route('students.store') }} " method="POST">
            @csrf
            Name : <input type="text" name="name" id=""><br>
            email : <input type="email" name="email" id=""><br>
            phone : <input type="text" name="phone" id=""><br>
            <input type="submit" value="Create Student">
        </form>
    </div>
</body>

</html> --}}

@extends('layouts.bootstrap')
@section('content')
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">

                <form class="form-example" action="{{ route('students.store') }}" method="POST">
                    @csrf
                    <div class="col-sm-10 mb-2">
                        <label for="staticEmail2" class="visually-hidden">Email</label>
                        <input type="text" name="email" class="form-control" id="staticEmail2"
                            placeholder="abc@xyz.com">
                    </div>
                    <div class="col-sm-10 mb-2">
                        <label for="name" class="visually-hidden">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="name" name="name">
                    </div>
                    <div class="col-sm-10 mb-2">
                        <label for="phone" class="visually-hidden">Ehone</label>
                        <input type="text" class="form-control" id="phone" placeholder="+212 681125703"
                            name="phone">
                    </div>
                    <div class="col-sm-10 mb-2">
                        <button type="submit" class="btn btn-primary mb-3">Create Student</button>
                    </div>
                    <a href="{{ route('students.index') }}">Return Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
