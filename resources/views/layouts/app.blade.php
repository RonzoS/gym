<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen">

    @include('partials.header')

    <main class="flex-grow container mx-auto mt-8">
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>
