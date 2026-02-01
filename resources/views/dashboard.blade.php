<x-app-layout>
    <x-slot name="header">
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
                    
                </div>
            </div>

            <!-- Cartes de statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
                <!-- Total des tâches -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900 rounded-lg p-2">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs font-medium text-gray-600 dark:text-gray-400">Total</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $totalTasks }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tâches à faire -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gray-100 dark:bg-gray-900 rounded-lg p-2">
                            <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs font-medium text-gray-600 dark:text-gray-400">À faire</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $todoTasks }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tâches en cours -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-100 dark:bg-yellow-900 rounded-lg p-2">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs font-medium text-gray-600 dark:text-gray-400">En cours</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $inProgressTasks }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tâches complétées -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 dark:bg-green-900 rounded-lg p-2">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs font-medium text-gray-600 dark:text-gray-400">Terminées</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $completedTasks }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tâches en retar -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-100 dark:bg-red-900 rounded-lg p-2">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs font-medium text-gray-600 dark:text-gray-400">En retard</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $overdueTasks }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pourcentage de complétion -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-100 dark:bg-purple-900 rounded-lg p-2">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs font-medium text-gray-600 dark:text-gray-400">Progression</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $completionPercentage }}%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barre de progression -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 mb-8">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Progression globale</h3>
                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $completedTasks }} / {{ $totalTasks }} tâches</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                    <div class="bg-gradient-to-r from-blue-500 to-green-500 h-3 rounded-full transition-all duration-500" 
                         style="width: {{ $completionPercentage }}%"></div>
                </div>
            </div>

            
            <!-- Barre de recherche et filtres -->
            <div class="mb-6">
                <form method="GET" action="{{ route('dashboard') }}" class="flex flex-col lg:flex-row gap-4">
                    <div class="flex-1 flex gap-2">
                        <input 
                            type="text" 
                            id="search-input"
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Rechercher une tâche..." 
                            class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-l-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <button 
                            type="button"
                            id="search-btn"
                            class="px-4 py-2 bg-blue-600 text-black rounded-r-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center"
                            title="Rechercher"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Rechercher
                        </button>
                    </div>
                    
                    <!-- Filtres par priorité et statut -->
                    <div class="flex gap-2">
                        <select 
                            name="status" 
                            onchange="this.form.submit()"
                            class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="">Statut</option>
                            <option value="à_faire" {{ request('status') == 'à_faire' ? 'selected' : '' }}>À Faire</option>
                            <option value="en_cours" {{ request('status') == 'en_cours' ? 'selected' : '' }}>En Cours</option>
                            <option value="terminé" {{ request('status') == 'terminé' ? 'selected' : '' }}>Terminées</option>
                        </select>
                        
                        <select 
                            name="priority" 
                            onchange="this.form.submit()"
                            class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="">Priorité</option>
                            <option value="basse" {{ request('priority') == 'basse' ? 'selected' : '' }}>Basse</option>
                            <option value="moyenne" {{ request('priority') == 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                            <option value="haute" {{ request('priority') == 'haute' ? 'selected' : '' }}>Haute</option>
                        </select>
                        
                        <!-- Tri par deadline -->
                        <a href="{{ route('dashboard', array_merge(request()->all(), ['deadline_sort' => request('deadline_sort') == 'asc' ? 'desc' : 'asc'])) }}" 
                           class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center gap-2"
                           title="Trier par deadline">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Deadline
                            @if(request('deadline_sort') == 'asc')
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                </svg>
                            @else
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            @endif
                        </a>
                        
                    </div>
                </form>
            </div>

            <!-- Kanban Board -->
            <div id="kanban-board" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- À Faire Column -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold text-gray-900 dark:text-white flex items-center">
                                <span class="w-2 h-2 bg-gray-400 rounded-full mr-2"></span>
                                {{ __('À Faire') }}
                                <span class="ml-2 text-xs text-gray-500">({{ $tachesAFaire->count() }})</span>
                            </h3>
                            <button id="addTaskAFaire" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Formulaire pour À Faire -->
                    <div id="formAFaire" class="hidden p-4 border-b border-gray-200 dark:border-gray-700">
                        <form method="POST" action="{{ route('tasks.store') }}">
                            @csrf
                            <input type="hidden" name="status" value="à_faire">
                            
                            <div class="space-y-3">
                                <input 
                                    type="text" 
                                    name="title" 
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white text-sm"
                                    placeholder="Titre de la tâche..."
                                >
                                
                                <textarea 
                                    name="description" 
                                    rows="2"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white text-sm"
                                    placeholder="Description (optionnel)..."
                                ></textarea>
                                
                                <div class="grid grid-cols-2 gap-2">
                                    <input 
                                        type="date" 
                                        name="deadline"
                                        min="{{ now()->format('Y-m-d') }}"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white text-sm"
                                    >
                                    
                                    <select 
                                        name="priority"
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white text-sm"
                                    >
                                        <option value="">Priorité</option>
                                        <option value="basse">Basse</option>
                                        <option value="moyenne" selected>Moyenne</option>
                                        <option value="haute">Haute</option>
                                    </select>
                                </div>
                                
                                                                
                                <div class="flex justify-end space-x-2">
                                    <button type="button" onclick="cancelFormAFaire()" class="px-3 py-1 text-sm border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded hover:bg-gray-50 dark:hover:bg-gray-700">
                                        Annuler
                                    </button>
                                    <button type="submit" class="px-3 py-1 text-sm bg-gray-600 text-black rounded hover:bg-gray-700">
                                        Ajouter
                                    </button>
                                </div>
                            </div>
                        </form>
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
                                        <div class="flex items-center space-x-2">
                                            <!-- Statut selector -->
                                            <select 
                                                onchange="updateTaskStatus({{ $tache->id }}, this.value)"
                                                class="text-xs px-2 py-1 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-500"
                                            >
                                                <option value="à_faire" {{ $tache->status == 'à_faire' ? 'selected' : '' }}>À Faire</option>
                                                <option value="en_cours" {{ $tache->status == 'en_cours' ? 'selected' : '' }}>En Cours</option>
                                                <option value="terminé" {{ $tache->status == 'terminé' ? 'selected' : '' }}>Terminé</option>
                                            </select>
                                            <a href="{{ route('tasks.edit', $tache->id) }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <button 
                                                onclick="confirmDeleteTask({{ $tache->id }}, '{{ $tache->title }}')"
                                                class="text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400"
                                                title="Supprimer la tâche"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
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
                            <span class="ml-3 text-sm font-normal text-gray-500 dark:text-gray-400">({{ $tachesEnCours->count() }})</span>
                        </h3>
                    </div>
                    
                    <!-- Formulaire pour En Cours -->
                    <div id="formEnCours" class="hidden p-4 border-b border-blue-200 dark:border-blue-700">
                        <form method="POST" action="{{ route('tasks.store') }}">
                            @csrf
                            <input type="hidden" name="status" value="en_cours">
                            
                            <div class="space-y-3">
                                <input 
                                    type="text" 
                                    name="title" 
                                    required
                                    class="w-full px-3 py-2 border border-blue-300 dark:border-blue-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white text-sm"
                                    placeholder="Titre de la tâche..."
                                >
                                
                                <textarea 
                                    name="description" 
                                    rows="2"
                                    class="w-full px-3 py-2 border border-blue-300 dark:border-blue-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white text-sm"
                                    placeholder="Description (optionnel)..."
                                ></textarea>
                                
                                <div class="grid grid-cols-2 gap-2">
                                    <input 
                                        type="date" 
                                        name="deadline"
                                        min="{{ now()->format('Y-m-d') }}"
                                        class="w-full px-3 py-2 border border-blue-300 dark:border-blue-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white text-sm"
                                    >
                                    
                                    <select 
                                        name="priority"
                                        required
                                        class="w-full px-3 py-2 border border-blue-300 dark:border-blue-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white text-sm"
                                    >
                                        <option value="">Priorité</option>
                                        <option value="basse">Basse</option>
                                        <option value="moyenne" selected>Moyenne</option>
                                        <option value="haute">Haute</option>
                                    </select>
                                </div>
                                
                                                                
                                <div class="flex justify-end space-x-2">
                                    <button type="button" onclick="cancelFormEnCours()" class="px-3 py-1 text-sm border border-blue-300 dark:border-blue-600 text-blue-700 dark:text-blue-300 rounded hover:bg-blue-50 dark:hover:bg-blue-900">
                                        Annuler
                                    </button>
                                    <button type="submit" class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                                        Ajouter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="p-4 space-y-3">
                        @if($tachesEnCours->count() > 0)
                            @foreach($tachesEnCours as $tache)
                                <div class="bg-white dark:bg-gray-700 rounded-lg p-4 shadow-sm border border-blue-200 dark:border-blue-600 cursor-pointer hover:shadow-md transition-shadow">
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
                                        <div class="flex items-center space-x-2">
                                            <!-- Statut selector -->
                                            <select 
                                                onchange="updateTaskStatus({{ $tache->id }}, this.value)"
                                                class="text-xs px-2 py-1 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-500"
                                            >
                                                <option value="à_faire" {{ $tache->status == 'à_faire' ? 'selected' : '' }}>À Faire</option>
                                                <option value="en_cours" {{ $tache->status == 'en_cours' ? 'selected' : '' }}>En Cours</option>
                                                <option value="terminé" {{ $tache->status == 'terminé' ? 'selected' : '' }}>Terminé</option>
                                            </select>
                                            <a href="{{ route('tasks.edit', $tache->id) }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <button 
                                                onclick="confirmDeleteTask({{ $tache->id }}, '{{ $tache->title }}')"
                                                class="text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400"
                                                title="Supprimer la tâche"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <h4 class="font-medium text-gray-900 dark:text-white mb-2 text-sm">{{ $tache->title }}</h4>
                                    @if($tache->description)
                                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-3">{{ Str::limit($tache->description, 80) }}</p>
                                    @endif
                                    <div class="flex items-center justify-between">
                                        <div class="flex -space-x-2">
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            @if($tache->deadline)
                                                <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    {{ $tache->deadline->format('d M') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
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
                        @if($tachesTerminees->count() > 0)
                            @foreach($tachesTerminees as $tache)
                                <div class="bg-white dark:bg-gray-700 rounded-lg p-4 shadow-sm border border-green-200 dark:border-green-600 cursor-pointer hover:shadow-md transition-shadow opacity-75">
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
                                        <div class="flex items-center space-x-2">
                                            <!-- Statut selector -->
                                            <select 
                                                onchange="updateTaskStatus({{ $tache->id }}, this.value)"
                                                class="text-xs px-2 py-1 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-500"
                                            >
                                                <option value="à_faire" {{ $tache->status == 'à_faire' ? 'selected' : '' }}>À Faire</option>
                                                <option value="en_cours" {{ $tache->status == 'en_cours' ? 'selected' : '' }}>En Cours</option>
                                                <option value="terminé" {{ $tache->status == 'terminé' ? 'selected' : '' }}>Terminé</option>
                                            </select>
                                            <a href="{{ route('tasks.edit', $tache->id) }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <button 
                                                onclick="confirmDeleteTask({{ $tache->id }}, '{{ $tache->title }}')"
                                                class="text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400"
                                                title="Supprimer la tâche"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <h4 class="font-medium text-gray-900 dark:text-white mb-2 text-sm">{{ $tache->title }}</h4>
                                    @if($tache->description)
                                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-3">{{ Str::limit($tache->description, 80) }}</p>
                                    @endif
                                    <div class="flex items-center justify-between">
                                        <div class="flex -space-x-2">
                                        </div>
                                        <div class="flex items-center space-x-2">
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
                                </div>
                            @endforeach
                        @endif

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

            
            <!-- Messages de succès/erreur -->
            @if(session('success'))
                <div class="mt-4 bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="mt-4 bg-red-50 dark:bg-red-900 border border-red-200 dark:border-red-700 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>

    <script>
        // Formulaire À Faire
        document.getElementById('addTaskAFaire').addEventListener('click', function() {
            const form = document.getElementById('formAFaire');
            form.classList.toggle('hidden');
            if (!form.classList.contains('hidden')) {
                form.querySelector('input[name="title"]').focus();
            }
        });

        function cancelFormAFaire() {
            document.getElementById('formAFaire').classList.add('hidden');
            document.querySelector('#formAFaire form').reset();
        }

        // Handle form submission with loading state pour tous les formulaires
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    const originalText = submitBtn.innerHTML;
                    
                    // Show loading state
                    submitBtn.innerHTML = `
                        <svg class="animate-spin h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Création...
                    `;
                    submitBtn.disabled = true;
                }
            });
        });

        // Function to update task status
        function updateTaskStatus(taskId, newStatus) {
            console.log('Updating task status:', taskId, 'to:', newStatus);
            
            // Show loading state
            const select = event.target;
            const originalValue = select.value;
            select.disabled = true;
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            console.log('CSRF token:', csrfToken);
            
            // Create form data instead of JSON
            const formData = new FormData();
            formData.append('status', newStatus);
            formData.append('_method', 'PUT');
            formData.append('_token', csrfToken);
            
            // Send request with form data
            fetch('/taches/' + taskId + '/status', {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(function(response) {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(function(data) {
                console.log('Response data:', data);
                if (data.success) {
                    // Show success message
                    showSuccessMessage(data.message);
                    // Reload page to show task in new column
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                } else {
                    // Show error message
                    showErrorMessage(data.message || 'Erreur lors de la mise à jour');
                    select.value = originalValue;
                    select.disabled = false;
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                showErrorMessage('Erreur lors de la mise à jour: ' + error.message);
                select.value = originalValue;
                select.disabled = false;
            });
        }

        // Function to show success message
        function showSuccessMessage(message) {
            var div = document.createElement('div');
            div.className = 'fixed top-4 right-4 bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg z-50';
            div.innerHTML = message;
            document.body.appendChild(div);
            
            setTimeout(function() {
                div.remove();
            }, 3000);
        }

        // Function to show error message
        function showErrorMessage(message) {
            var div = document.createElement('div');
            div.className = 'fixed top-4 right-4 bg-red-50 dark:bg-red-900 border border-red-200 dark:border-red-700 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg z-50';
            div.innerHTML = message;
            document.body.appendChild(div);
            
            setTimeout(function() {
                div.remove();
            }, 3000);
        }

        // Function to confirm task deletion
        function confirmDeleteTask(taskId, taskTitle) {
            if (confirm('Êtes-vous sûr de vouloir supprimer la tâche "' + taskTitle + '" ?\n\nCette action est irréversible.')) {
                // Create form for deletion
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/taches/' + taskId;
                form.style.display = 'none';
                
                // Add CSRF token
                var csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                form.appendChild(csrfToken);
                
                // Add method override for DELETE
                var methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
                
                // Submit form
                document.body.appendChild(form);
                form.submit();
            }
        }

        // AJAX Search and Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const searchBtn = document.getElementById('search-btn');
            const kanbanBoard = document.getElementById('kanban-board');

            // Function to perform AJAX search
            function performSearch() {
                console.log('performSearch called');
                
                const searchValue = searchInput.value.trim();
                console.log('Search value:', searchValue);

                // Show loading state
                kanbanBoard.style.opacity = '0.5';
                
                // Reset opacity after 5 seconds in case of error
                setTimeout(() => {
                    kanbanBoard.style.opacity = '1';
                }, 5000);
                
                // Only search if there's a value
                if (!searchValue) {
                    kanbanBoard.style.opacity = '1';
                    return;
                }
                
                const url = `/dashboard/search?search=${encodeURIComponent(searchValue)}`;
                console.log('Fetching URL:', url);
                
                // Make AJAX request
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'text/html',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    return response.text();
                })
                .then(html => {
                    console.log('Response received, length:', html.length);
                    
                    // Parse the HTML response
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newKanbanBoard = doc.getElementById('kanban-board');
                    
                    if (newKanbanBoard) {
                        kanbanBoard.innerHTML = newKanbanBoard.innerHTML;
                        kanbanBoard.style.opacity = '1';
                        console.log('Kanban board updated');
                    } else {
                        console.error('Kanban board not found in response');
                        kanbanBoard.style.opacity = '1';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    kanbanBoard.style.opacity = '1';
                    showErrorMessage('Erreur lors de la recherche');
                });
            }

            // Event listeners
            searchBtn.addEventListener('click', performSearch);
            
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    performSearch();
                }
            });

            // Auto-search on each keystroke with shorter debounce
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(performSearch, 300); // Plus rapide : 300ms
            });
        });
    </script>
</x-app-layout>
