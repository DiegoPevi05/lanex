<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-type="service" data-radius="soft" data-buttons="solid" data-motion="live">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        @php
            $pageTitle = trim($__env->yieldContent('title')) ?: 'LanEx — Operador Logístico Internacional y Agenciamiento de Carga';
            $pageDesc = trim($__env->yieldContent('meta_description')) ?: __('messages.meta.home');
            $pageRobots = trim($__env->yieldContent('robots')) ?: 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
            $pageImage = trim($__env->yieldContent('og_image')) ?: asset('images/og-preview.jpg');
            $pageType = trim($__env->yieldContent('og_type')) ?: 'website';
            $canonicalUrl = trim($__env->yieldContent('canonical')) ?: url()->current();
        @endphp

        <!-- Primary Meta Tags -->
        <title>{{ $pageTitle }}</title>
        <meta name="title" content="{{ $pageTitle }}">
        <meta name="description" content="{{ $pageDesc }}">
        <meta name="keywords" content="LanEx, Express Lane Logistics, operador logistico internacional, agenciamiento de aduana, carga maritima FCL LCL, carga aerea, transporte multimodal, importacion china peru, logistica internacional lima">
        <meta name="author" content="LanEx - Express Lane Logistics S.A.C.">
        <meta name="theme-color" content="#0f172a">

        <!-- Canonical URL -->
        <link rel="canonical" href="{{ $canonicalUrl }}">

        <!-- Crawlers & Search Bots Directives -->
        <meta name="robots" content="{{ $pageRobots }}">
        <meta name="googlebot" content="{{ $pageRobots }}">
        <meta name="bingbot" content="{{ $pageRobots }}">

        <!-- Open Graph / Facebook / WhatsApp / LinkedIn -->
        <meta property="og:site_name" content="LanEx Logistics">
        <meta property="og:type" content="{{ $pageType }}">
        <meta property="og:locale" content="{{ app()->getLocale() == 'en' ? 'en_US' : 'es_PE' }}">
        <meta property="og:url" content="{{ $canonicalUrl }}">
        <meta property="og:title" content="{{ $pageTitle }}">
        <meta property="og:description" content="{{ $pageDesc }}">
        <meta property="og:image" content="{{ $pageImage }}">
        <meta property="og:image:secure_url" content="{{ $pageImage }}">
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="{{ $pageTitle }}">

        <!-- Twitter / X Cards -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="{{ $canonicalUrl }}">
        <meta name="twitter:title" content="{{ $pageTitle }}">
        <meta name="twitter:description" content="{{ $pageDesc }}">
        <meta name="twitter:image" content="{{ $pageImage }}">
        <meta name="twitter:image:alt" content="{{ $pageTitle }}">

        <!-- Favicons & Touch Icons -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            h1 { font-size: 2.75rem; line-height: 1.15; font-weight: 800; }
            h2 { font-size: 2rem; line-height: 1.25; font-weight: 700; }
            h3 { font-size: 1.5rem; line-height: 1.35; font-weight: 700; }
            h4 { font-size: 1.25rem; line-height: 1.4; font-weight: 600; }
            h5 { font-size: 1rem; line-height: 1.5; font-weight: 600; }
        </style>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

        <!-- Structured Data: Organization & WebSite (JSON-LD) -->
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@graph": [
            {
              "@type": "Organization",
              "@id": "https://lanexsac.com/#organization",
              "name": "LanEx",
              "legalName": "Express Lane Logistics S.A.C.",
              "url": "https://lanexsac.com",
              "logo": {
                "@type": "ImageObject",
                "url": "{{ asset('images/logo.png') }}",
                "width": 200,
                "height": 200
              },
              "image": "{{ asset('images/og-preview.jpg') }}",
              "description": "Operador logístico internacional y agenciamiento de carga. Soluciones integrales en transporte marítimo, aéreo, terrestre y despacho aduanero.",
              "address": {
                "@type": "PostalAddress",
                "streetAddress": "Av. Perú",
                "addressLocality": "Los Olivos",
                "addressRegion": "Lima",
                "postalCode": "15133",
                "addressCountry": "PE"
              },
              "contactPoint": [
                {
                  "@type": "ContactPoint",
                  "telephone": "+51-992-764-991",
                  "contactType": "customer service",
                  "areaServed": "PE",
                  "availableLanguage": ["Spanish", "English"]
                }
              ]
            },
            {
              "@type": "WebSite",
              "@id": "https://lanexsac.com/#website",
              "url": "https://lanexsac.com",
              "name": "LanEx Logistics",
              "publisher": {
                "@id": "https://lanexsac.com/#organization"
              },
              "inLanguage": "{{ app()->getLocale() == 'en' ? 'en-US' : 'es-PE' }}"
            }
          ]
        }
        </script>
        @stack('head')
    </head>
    <body class="antialiased min-h-screen bg-transparent h-full w-full">
        <x-toast/>
        @yield('content')
    </body>
</html>
