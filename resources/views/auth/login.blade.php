<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <!-- Login Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl mb-6 shadow-lg">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
        </div>
        <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-3">
            TaskBoard
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-400">
            {{ __('Connectez-vous pour gérer vos tâches efficacement') }}
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Adresse Email')" class="block text-sm font-semibold text-gray-700 dark:text-gray-300" />
            <x-text-input id="email" class="block w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200 shadow-sm hover:shadow-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="email@exemple.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('Mot de passe')" class="block text-sm font-semibold text-gray-700 dark:text-gray-300" />
            <x-text-input id="password" class="block w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200 shadow-sm hover:shadow-lg"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" class="h-5 w-5 text-indigo-600 focus:ring-2 focus:ring-indigo-500 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600" name="remember">
                <label for="remember_me" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Se souvenir de moi') }}
                </label>
            </div>

            @if (Route::has('password.request'))
                <div class="text-sm">
                    <a class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition duration-200" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié?') }}
                    </a>
                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <x-primary-button class="w-full justify-center py-4 text-lg font-semibold rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>

        <!-- Register Link -->
        <div class="text-center pt-6 border-t border-gray-200 dark:border-gray-700">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('Pas encore de compte?') }}
                <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors">
                    {{ __('Créer un compte') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
