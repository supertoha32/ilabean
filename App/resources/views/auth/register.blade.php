@extends("layouts.basic-layout")

@section('content')
    <div class="w-1/3 mx-auto my-20">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
            <div>
                <x-label for="name" :value="__('ФИО')"/>

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                         autofocus/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Почта')"/>

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
            </div>

            <!-- Number -->
            <div class="mt-4">
                <x-label for="email" :value="__('Телефон')"/>

                <x-input id="number" class="block mt-1 w-full" type="text" name="number" :value="old('number')" required/>
            </div>

            <!-- TIN -->
            <div class="mt-4">
                <x-label for="email" :value="__('ИНН')"/>

                <x-input id="TIN" class="block mt-1 w-full" type="text" name="TIN" :value="old('TIN')" required/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Пароль')"/>

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="new-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Подтвердите пароль')"/>

                <x-input id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation" required/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Зарегистрированы?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Зарегистрироваться') }}
                </x-button>
            </div>
        </form>
    </div>
@endsection
