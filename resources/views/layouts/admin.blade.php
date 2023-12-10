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
    <body class="font-sans antialiased relative bg-brand-light">
        <div class="min-h-screen">
            <main>
                <div class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8">
                    <div class="hidden lg:block fixed z-20 inset-0 top-0 left-[max(0px,calc(50%-45rem))] right-auto w-[19rem] pb-10 pl-8 pr-6 pt-6 overflow-y-auto">
                        <x-admin-nav>
                            <x-nav-link-admin-pane link="{{ route('products.index') }}" label="{{ __('Products') }}"
                                                   selected="{{ str_contains(Route::currentRouteName(), 'products') }}">
                                <x-slot name="icon">
                                    <x-heroicons-cube class="w-5 h-5"></x-heroicons-cube>
                                </x-slot>
                            </x-nav-link-admin-pane>
                            <x-nav-link-admin-pane link="{{ route('tags.index') }}" label="{{ __('Tags') }}"
                                                   selected="{{ str_contains(Route::currentRouteName(), 'tags') }}">
                                <x-slot name="icon">
                                    <x-heroicons-tag class="w-5 h-5"></x-heroicons-tag>
                                </x-slot>
                            </x-nav-link-admin-pane>
                            <x-nav-link-admin-pane link="{{ route('categories.index') }}" label="{{ __('Categories') }}"
                                                   selected="{{ str_contains(Route::currentRouteName(), 'categories') }}">
                                <x-slot name="icon">
                                    <x-heroicons-squares-2x2 class="w-5 h-5"></x-heroicons-squares-2x2>
                                </x-slot>
                            </x-nav-link-admin-pane>
                        </x-admin-nav>
                    </div>
                    <div class="lg:pl-[19.5rem]">
                        {{ $slot }}
                    </div>
                </div>
            </main>

            <x-notification></x-notification>
        </div>

    <x-modal name="cart" from="end">
        <x-cart></x-cart>
    </x-modal>
    </body>
</html>
