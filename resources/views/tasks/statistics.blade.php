<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Statistiques des tâches') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Mes Statistiques</h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">Vue d'ensemble de votre progression</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Voir les tâches
                        </a>
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <!-- Cartes de statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total des tâches -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900 rounded-lg p-3">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total des tâches</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalTasks }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tâches à faire -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gray-100 dark:bg-gray-900 rounded-lg p-3">
                            <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">À faire</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $todoTasks }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tâches en cours -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-100 dark:bg-yellow-900 rounded-lg p-3">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">En cours</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $inProgressTasks }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tâches complétées -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 dark:bg-green-900 rounded-lg p-3">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Terminées</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $completedTasks }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tâches en retard -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-100 dark:bg-red-900 rounded-lg p-3">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">En retard</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $overdueTasks }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pourcentage de complétion -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-100 dark:bg-purple-900 rounded-lg p-3">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Taux de complétion</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $completionPercentage }}%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barre de progression -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Progression globale</h3>
                <div class="relative">
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-8">
                        <div class="bg-gradient-to-r from-blue-500 to-green-500 h-8 rounded-full flex items-center justify-center text-white text-sm font-medium transition-all duration-500" 
                             style="width: {{ $completionPercentage }}%">
                            {{ $completionPercentage }}%
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex justify-between text-sm text-gray-600 dark:text-gray-400">
                    <span>{{ $completedTasks }} terminées</span>
                    <span>{{ $totalTasks }} totales</span>
                </div>
            </div>

            <!-- Résumé détaillé -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Résumé détaillé</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-400">Tâches à faire</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $todoTasks }} ({{ $totalTasks > 0 ? round(($todoTasks / $totalTasks) * 100, 1) : 0 }}%)</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-400">Tâches en cours</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $inProgressTasks }} ({{ $totalTasks > 0 ? round(($inProgressTasks / $totalTasks) * 100, 1) : 0 }}%)</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-400">Tâches terminées</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $completedTasks }} ({{ $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100, 1) : 0 }}%)</span>
                    </div>
                    @if($overdueTasks > 0)
                    <div class="flex justify-between items-center border-t border-gray-200 dark:border-gray-700 pt-4">
                        <span class="text-red-600 dark:text-red-400 font-medium">⚠️ Tâches en retard</span>
                        <span class="font-medium text-red-600 dark:text-red-400">{{ $overdueTasks }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
