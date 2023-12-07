<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased relative" style="background: url('{{ __('/assets/background.jpg') }}'); background-size: 100% auto">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <div class="fixed right-0 bottom-0 m-6 gap-3 flex flex-col" x-data="{
                    notifications: [],
                }" x-on:push-notification.window="notifications.push($event.detail)">
                <template x-for="notification in notifications">
                    <div class="rounded-lg p-4 shadow-xl backdrop-blur-xl transform transition-all" :class="notification.color"
                         x-data="{show: false}"
                         x-show="show"
                         x-init="$nextTick(() => { show = true });setTimeout(() => show = false, 5000);"
                         x-transition:enter="ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                         x-transition:leave="ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    >
                        <span class="font-semibold text-sm text-white" x-text="notification.title"></span><br/>
                        <span class="text-sm text-white" x-text="notification.text"></span><br/>
                    </div>
                </template>
            </div>
        </div>

    <x-modal name="cart" from="end">
        <x-cart></x-cart>
    </x-modal>
    </body>
</html>
