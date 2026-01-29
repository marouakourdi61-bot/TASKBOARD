<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tableau de bord') }}
            </h2>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>{{ __('Nouvelle tâche') }}</span>
            </button>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Project Header -->
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">TaskBoard Project</h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ __('Gestion des tâches et projets') }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span>4 membres</span>
                        </div>
                        <button class="p-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Kanban Board -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- À Faire Column -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold text-gray-900 dark:text-white flex items-center">
                                <span class="w-2 h-2 bg-gray-400 rounded-full mr-2"></span>
                                {{ __('À Faire') }}
                                <span class="ml-2 text-xs text-gray-500">(3)</span>
                            </h3>
                            <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                        </div>
                            <span class="ml-3 text-sm font-normal text-gray-500 dark:text-gray-400">(3)</span>
                        </h3>
                        <button class="px-3 py-1 text-sm bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                            {{ __('Ajouter une tâche') }}
                        </button>
                    </div>
                    
                    <div class="p-4 space-y-3">
                        @if($tachesAFaire->count() > 0)
                            @foreach($tachesAFaire as $tache)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 border border-gray-200 dark:border-gray-600 cursor-pointer hover:shadow-sm transition-shadow">
                                    <div class="flex items-start justify-between mb-2">
                                        <span class="text-xs font-medium 
                                            @if($tache->priority == 'haute')
                                                text-red-600 bg-red-100 dark:bg-red-900
                                            @elseif($tache->priority == 'moyenne')
                                                text-yellow-600 bg-yellow-100 dark:bg-yellow-900
                                            @else
                                                text-green-600 bg-green-100 dark:bg-green-900
                                            @endif
                                            px-2 py-1 rounded">
                                            {{ ucfirst($tache->priority) }}
                                        </span>
                                        <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <h4 class="font-medium text-gray-900 dark:text-white mb-2 text-sm">{{ $tache->title }}</h4>
                                    @if($tache->description)
                                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-3">{{ Str::limit($tache->description, 80) }}</p>
                                    @endif
                                    <div class="flex items-center justify-between">
                                        <div class="flex -space-x-2">
                                        </div>
                                        @if($tache->deadline)
                                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $tache->deadline->format('d/m') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <!-- Add Task Button -->
                        <button class="w-full p-3 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-gray-600 dark:text-gray-400 hover:border-gray-400 dark:hover:border-gray-500 hover:text-gray-900 dark:hover:text-white transition-colors flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span class="text-sm">{{ __('Ajouter une tâche') }}</span>
                        </button>
                    </div>
                </div>

                <!-- En Cours Column -->
                <div class="bg-blue-50 dark:bg-gray-800 rounded-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-semibold text-lg text-gray-900 dark:text-white flex items-center">
                            <span class="w-3 h-3 bg-blue-500 rounded-full mr-3"></span>
                            {{ __('En Cours') }}
                            <span class="ml-3 text-sm font-normal text-gray-500 dark:text-gray-400">(2)</span>
                        </h3>
                        <button class="px-3 py-1 text-sm bg-blue-200 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-300 dark:hover:bg-blue-800 transition-colors">
                            {{ __('Ajouter une tâche') }}
                        </button>
                    </div>
                    
                    <div class="p-4 space-y-3">
                        <!-- Task Card 3 -->
                        <div class="bg-white dark:bg-gray-700 rounded-lg p-4 shadow-sm border border-blue-200 dark:border-blue-600 cursor-pointer hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between mb-2">
                                <span class="text-xs font-medium text-red-600 bg-red-100 dark:bg-red-900 px-2 py-1 rounded">Haute</span>
                                <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                    </svg>
                                </button>
                            </div>
                            <h4 class="font-medium text-gray-900 dark:text-white mb-2">Développer le module d'authentification</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Implémenter OAuth2 et JWT</p>
                            <div class="flex items-center justify-between">
                                <div class="flex -space-x-2">
                                </div>
                                <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    20 Jan
                                </div>
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <button class="w-full p-3 border-2 border-dashed border-blue-300 dark:border-blue-600 rounded-lg text-blue-600 dark:text-blue-400 hover:border-blue-400 dark:hover:border-blue-500 hover:text-blue-700 dark:hover:text-blue-300 transition-colors flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            {{ __('Ajouter une tâche') }}
                        </button>
                    </div>
                </div>

               

                <!-- Terminé Column -->
                <div class="bg-green-50 dark:bg-gray-800 rounded-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-semibold text-lg text-gray-900 dark:text-white flex items-center">
                            <span class="w-3 h-3 bg-green-500 rounded-full mr-3"></span>
                            {{ __('Terminé') }}
                            <span class="ml-3 text-sm font-normal text-gray-500 dark:text-gray-400">(4)</span>
                        </h3>
                        <button class="px-3 py-1 text-sm bg-green-200 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg hover:bg-green-300 dark:hover:bg-green-800 transition-colors">
                            {{ __('Ajouter une tâche') }}
                        </button>
                    </div>
                    
                    <div class="p-4 space-y-3">
                        <!-- Task Card 6 -->
                        <div class="bg-white dark:bg-gray-700 rounded-lg p-4 shadow-sm border border-green-200 dark:border-green-600 cursor-pointer hover:shadow-md transition-shadow opacity-75">
                            <div class="flex items-start justify-between mb-2">
                                <span class="text-xs font-medium text-green-600 bg-green-100 dark:bg-green-900 px-2 py-1 rounded">Basse</span>
                                <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                    </svg>
                                </button>
                            </div>
                            <h4 class="font-medium text-gray-900 dark:text-white mb-2">Configuration de l'environnement CI/CD</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">GitHub Actions configuré</p>
                            <div class="flex items-center justify-between">
                                <div class="flex -space-x-2">
                                </div>
                                <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    10 Jan
                                </div>
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <button class="w-full p-3 border-2 border-dashed border-green-300 dark:border-green-600 rounded-lg text-green-600 dark:text-green-400 hover:border-green-400 dark:hover:border-green-500 hover:text-green-700 dark:hover:text-green-300 transition-colors flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            {{ __('Ajouter une tâche') }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Bar -->
            <div class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">10</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Tâches totales') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">2</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('En cours') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">1</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('En revue') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400">4</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Terminées') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
