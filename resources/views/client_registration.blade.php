<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Sign Up With Us</title>
</head>
<body>

    <form action="{{ route('register.newClient') }}" method="post" class="flex flex-col justify-center items-center mt-16 ">
        @csrf

        <!-- Organization Name -->
        <div>
            <x-input-label for="name" :value="__('Organization Name')" />
            <x-text-input id="name" class="block mt-1 w-96" type="text" name="client_name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Organization Address -->
        <div>
            <x-input-label for="address" :value="__('Organization Address')" />
            <x-text-area  class="block mt-1 w-96" rows="4" cols="50" type="text" name="client_address"/>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

         <!-- Organization Email  -->
         <div class="mt-4">
            <x-input-label for="organization_email" :value="__('Organization Email')" />
            <x-text-input id="organization_email" class="block mt-1 w-96" type="email" name="organization_email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('organization_email')" class="mt-2" />
        </div>

         <!-- Phone Number -->
         <div>
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" class="block mt-1 w-96" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Client Admin Name -->
        <div>
            <x-input-label for="admin" :value="__('Admin Name')" />
            <x-text-input id="admin" class="block mt-1 w-96" type="text" name="admin_name" :value="old('admin_name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('admin_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-96" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-96"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-96"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</body>
</html>