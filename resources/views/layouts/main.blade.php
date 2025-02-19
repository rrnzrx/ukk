<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Include CSRF token -->
    <title>Dashboard Siswa</title>
    <link rel="icon" type="image/logo" href="/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>


<body class="flex">

    @include('layouts.sidebar')

    @yield('content')

</body>


</html>
