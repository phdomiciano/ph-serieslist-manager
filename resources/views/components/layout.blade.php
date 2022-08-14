<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{$title}} - Series Manager</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body>
    @auth
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('series.index') }}" style="color:grey">Home</a>
            <group>
                <label class="display-8" style="color:grey">List of {{ Auth::user()->name; }} | </label>
                <a href="{{ route('logout') }}" class="btn btn-secondary btn-sm">Logout</a>
            </group>
        </nav>
    @endauth
    <div class="container">
        <div class="jumbotron">
            <br />
            <h1 class="display-4">{{$title}}</h1>
            <hr class="my-4">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{$slot}}
        </div>
    </div>
    <br />
</body>
</html>