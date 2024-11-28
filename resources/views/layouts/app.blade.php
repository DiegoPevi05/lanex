<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('meta_description', __('messages.meta.home'))">
        <meta name="keywords" content="LanEx, Express Lane Logistics, soluciones de carga, logística, entrega exprés, servicios de transporte, envíos, empresa de logística">
        <meta name="author" content="LanEx">

        <title>LanEx</title>

        <!-- Social Tags -->
        <meta name="title" content="LanEx | Express Lane Logistics - Soluciones Rápidas y Confiables">
        <meta property="og:title" content="LanEx | Express Lane Logistics">
        <meta property="og:description" content="Brindamos soluciones rápidas y confiables de logística y transporte adaptadas a tus necesidades.">
        <meta property="og:image" content="/images/logo.png">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta name="robots" content="index, follow">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <!-- Styles -->
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <!-- Structure Schema -->
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "WebPage",
          "name": "LanEx",
          "headline": "LanEx | Express Lane Logistics - Soluciones Rápidas y Confiables",
          "url": "{{ url('/') }}",
          "logo": "{{ asset('images/logo.png') }}",
          "description": "Brindamos soluciones rápidas y confiables de logística y transporte adaptadas a tus necesidades.",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Av.Perú",
            "addressLocality": "Los Olivos",
            "addressRegion": "Lima",
            "postalCode": "15133",
            "addressCountry": "Perú"
          },
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+51 992-764-991",
            "contactType": "Servicio al Cliente"
          }
        }
        </script>
    </head>
    <body class="antialiased min-h-screen bg-transparent h-full w-full">
        <x-toast/>
        @yield('content') <!-- Inject content from specific views -->
    </body>
</html>
