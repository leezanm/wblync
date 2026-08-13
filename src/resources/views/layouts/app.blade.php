<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        {{ config('app.name', 'WBLync') }}
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-[Poppins] bg-slate-100 text-slate-800">

    <div
        x-data="{ sidebarOpen: false }"
        class="min-h-screen"
    >

        {{-- Mobile Overlay --}}
        <div
            x-show="sidebarOpen"
            x-transition.opacity
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-slate-900/50 lg:hidden"
        ></div>

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Main Area --}}
        <div class="lg:pl-72 min-h-screen">

            {{-- Topbar --}}
            @include('layouts.topbar')

            {{-- Content --}}
            <main class="p-4 sm:p-6 lg:p-8">

                @isset($header)
                    {{-- <div class="mb-6">
                        {{ $header }}
                    </div> --}}
                @endisset

                {{ $slot }}

            </main>

        </div>

    </div>

</body>
</html>
