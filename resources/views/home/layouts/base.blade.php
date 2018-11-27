<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta type="keywords" content="@yield('keywords','')">
    <meta type="description" content="@yield('description','')">
    <title>@yield('title','')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body>

    @include('_header')

    @section('content')

    @endsection

    @include('_footer')

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')

</body>
</html>