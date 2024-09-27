<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lanex</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <!-- Styles -->
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased min-h-screen bg-white h-full w-full">
        <x-navbar /> <!-- Include the Navbar component -->

        <main class="w-full h-auto">
            @yield('content') <!-- Inject content from specific views -->
        </main>

        <x-footer />

    </body>
</html>
