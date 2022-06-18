<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased md:h-screen md:overflow-y-hidden inactive">

    <div class="min-h-screen bg-gray-100 md:h-full">

        @include('layouts.loading')
        <div class="h-[16px]"></div>
        @include('layouts.navigation')
        <div class="h-[16px]"></div>

        <div class="flex flex-wrap md:flex-nowrap md:h-full">

            <livewire:sidebar />

            <section class="grow md:relative">
                <div class="md:absolute md:top-0 md:bottom-[64px] md:right-0 md:left-0 md:overflow-y-auto">
                    <main class="container mx-auto pb-8">
                        {{ $slot }}
                    </main>
                </div>
            </section>

        </div>
    </div>


</body>

</html>
