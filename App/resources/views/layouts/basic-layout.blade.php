<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('/js/app.js') }}"></script>

    <title>Laravel</title>
</head>
<body>
<div id="app" class="font-sans antialiased">
    <div class="mx-auto text-gray-800 min-h-screen">
        <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('home') }}">
                                    <x-application-logo class="block h-10 w-auto fill-current text-gray-600"/>
                                </a>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <x-nav-link :href="route('sell')" :active="request()->routeIs('sell')">
                                    {{ __('Поставщику') }}
                                </x-nav-link>
                                <x-nav-link :href="route('buy')" :active="request()->routeIs('buy')">
                                    {{ __('Заказчику') }}
                                </x-nav-link>
                            </div>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            @auth
                                <a href="{{\Illuminate\Support\Facades\URL::to('/chats')}}" class="w-4 h-4 w-fit mr-2 flex relative">
                                    <img src="{{\Illuminate\Support\Facades\URL::to('/img/notification.png')}}" alt="Уведомления">
                                    @php
                                        $user = \Illuminate\Support\Facades\Auth::user()->id;
                                        $msg = \App\Models\Message::query()->where('seen', false)->where('to_id', $user)->get()->count();
                                    @endphp
                                    @if($msg > 0)
                                        <span class="text-gray-50 bg-red-500 h-fit w-fit rounded-full px-1.5 py-0.5 text-xs absolute inset-0">{{$msg}}</span>
                                    @endif
                                </a>
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                            <div>{{ Auth::user()->name }}</div>

                                            <div class="ml-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('dashboard')">
                                            {{ __('Кабинет') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link :href="route('logout')"
                                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                {{ __('Выйти') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @else
                                <a href="{{ route('login') }}"
                                   class="text-sm text-gray-700 hover:text-blue-600 underline">Войти</a>
                                <span class="mx-1.5">|</span>
                                <a href="{{ route('register') }}"
                                   class=" hover:text-blue-600 text-sm text-gray-700 underline">Зарегистрироваться</a>
                            @endauth
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="open = ! open"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 12h16M4 18h16"/>
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                          stroke-linecap="round"
                                          stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link :href="route('sell')" :active="request()->routeIs('sell')">
                            {{ __('Поставщику') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('buy')" :active="request()->routeIs('buy')">
                            {{ __('Заказчику') }}
                        </x-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        @auth
                            <div class="px-4">
                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            </div>

                            <div class="mt-1 space-y-1">
                                <x-responsive-nav-link :href="route('dashboard')"
                                                       :active="request()->routeIs('dashboard')">
                                    {{ __('Кабинет') }}
                                </x-responsive-nav-link>
                            </div>

                            <div class="space-y-1">
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-responsive-nav-link :href="route('logout')"
                                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        {{ __('Выйти') }}
                                    </x-responsive-nav-link>
                                </form>
                            </div>
                        @else
                            <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('buy')">
                                {{ __('Войти') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('buy')">
                                {{ __('Зарегистрироваться') }}
                            </x-responsive-nav-link>
                        @endauth
                    </div>
                </div>
            </nav>
        </header>
        <div class="w-10/12 mx-auto">
            @yield('content')
        </div>
    </div>
    <footer class="flex flex-col md:flex-row py-5 justify-between w-full px-10 text-gray-600 bg-gray-50">
        <div class="">@ Labean 2022. Все права защищены.</div>
        <div class="">
            <nav class="">
                <ul class="flex flex-col md:flex-row justify-between">
                    <li class="mr-5"><a class="hover:text-blue-600" href="{{URL::to('/sell')}}">Поставщику</a></li>
                    <li class="mr-5"><a class="hover:text-blue-600" href="{{URL::to('/buy')}}">Заказчику</a></li>
                    <li><a class="hover:text-blue-600" href="{{URL::to('/support')}}">Поддержка</a></li>
                </ul>
            </nav>
        </div>
    </footer>
</div>
</body>
</html>
