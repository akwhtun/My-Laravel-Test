<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <title>Document</title>
</head>

<body>
    <div class="container-md border border-4 border-info bg-dark text-info mt-0 mt-md-1">
        <div class="row">
            <h5 class="bg-info text-dark w-100 p-1 col-12">
                <img src="{{ asset('images/logo.png') }}" alt="logo" style="width: 40px;">
                <span style="font-weight:300;font-family: Arial, Helvetica, sans-serif;font-size: 20px">My
                    Articles</span>
            </h5>
        </div>
        @yield('content')
    </div>
    {{-- JS --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
