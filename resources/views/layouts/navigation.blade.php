<nav x-data="navigation()" x-init="init"
     class="sticky top-0 z-40 text-gray-200"
     :class="atTopOfPage ? 'bg-brand-brown' : 'bg-brand-brown/60 backdrop-blur-lg shadow-lg'">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('homepage') }}" class="flex flex-row items-center gap-4">
                        <img src="{{ __('/assets/logo.png') }}" class="h-16">
                    </a>
                </div>

                <div class="hidden space-x-8 sm:my-auto sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Creators') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:my-auto sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Brands') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:my-auto sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Artists') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 sm:gap-1">
                @if (Auth::check() && Auth::user()->hasPermission(\App\Models\Permission::$ADMINISTRATOR_ACCESS))
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-gray-800 hover:text-white hover:bg-orange-500/70 hover:backdrop-blur dark:hover:text-gray-300">
                            <div class="me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </div>

                            {{ __('Administrator Panel') }}

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if (Auth::check() && Auth::user()->hasPermission(\App\Models\Permission::$PRODUCT_MASTER))
                        <x-dropdown-link :href="route('tags.index')">
                            {{ __('Setup Tag') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('products.index')">
                            {{ __('Setup Product') }}
                        </x-dropdown-link>
                        @endif
                    </x-slot>
                </x-dropdown>
                @endif

                @if (Auth::check())
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-gray-800 hover:text-white hover:bg-orange-500/70 hover:backdrop-blur">
                            <div class="me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </div>

                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @endif
                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-xl text-white hover:text-brand-brown hover:bg-white hover:backdrop-blur"
                    @click="$dispatch('open-modal', 'cart')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </button>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @if (Auth::check())
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            @endif
        </div>
        @if (Auth::check() && Auth::user()->hasPermission(\App\Models\Permission::$ADMINISTRATOR_ACCESS))
            <div class="pt-4 pb-3 space-y-1 border-t border-gray-200 dark:border-gray-600">
                <div class="inline-flex px-4">
                    <div class="me-1 flex">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                        </div>
                    </div>

                    {{ __('Administrator Panel') }}
                </div>
                @if (Auth::check() && Auth::user()->hasPermission(\App\Models\Permission::$PRODUCT_MASTER))
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('tags.index')">
                        {{ __('Setup Tag') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('products.index')">
                        {{ __('Setup Product') }}
                    </x-responsive-nav-link>
                </div>
                @endif
            </div>
        @endif
    </div>
</nav>

<script>
    function navigation() {
        return {
            open: false,
            atTopOfPage: true,
            xxx: 20,
            init() {
                const self = this;
                window.addEventListener('scroll', () => {
                    console.log(self.atTopOfPage)
                    if (window.scrollY > 0){
                        if (self.atTopOfPage) self.atTopOfPage = false
                    } else {
                        if(!self.atTopOfPage) self.atTopOfPage = true
                    }
                });
            },
            // handleScroll() {
            //     setTimeout(() => {
            //         console.log(this.atTopOfPage)
            //         this.$dispatch('on-scroll-y', window.scrollY);
            //         if (window.scrollY > 0){
            //             if (this.atTopOfPage) this.atTopOfPage = false
            //         } else {
            //             if(!this.atTopOfPage) this.atTopOfPage = true
            //         }
            //     }, 100)
            // },
            // onScrollY(scrollY) {
            //     console.log(scrollY);
            //     console.log(this.atTopOfPage)
            // }
        }
    }
</script>
