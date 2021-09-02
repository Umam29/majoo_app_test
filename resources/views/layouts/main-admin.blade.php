<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
</head>

<body>
    @include('layouts.sidebar')

    @yield('content')

    @include('layouts.footer')

</body>

</html>
