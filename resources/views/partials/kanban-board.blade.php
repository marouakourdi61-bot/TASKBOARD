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
        
        <div id="formAFaire" class="hidden p-4 border-b border-gray-200 dark:border-gray-700">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="space-y-3">
                    <div>
                        <input 
                            type="text" 
                            name="title" 
                            placeholder="Titre de la tâche..." 
                            required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white text-sm"
                        >
                    </div>
                    
                    <div>
                        <textarea 
                            name="description" 
                            placeholder="Description..." 
                            rows="2"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white text-sm resize-none"
                        ></textarea>
                    </div>
                    
                    <div>
                        <input 
                            type="datetime-local" 
                            name="deadline" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:text-white text-sm"
                        >
                    </div>
                    
                    <div>
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
                    
                    <input type="hidden" name="status" value="à_faire">
                    
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="cancelFormAFaire()" class="px-3 py-1 text-sm border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded hover:bg-gray-50 dark:hover:bg-gray-700">
                            Annuler
                        </button>
                        <button type="submit" class="px-3 py-1 text-sm bg-gray-600 text-white rounded hover:bg-gray-700">
                            Ajouter
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="p-4 space-y-3">
            @if($tachesAFaire->count() > 0)
                @foreach($tachesAFaire as $tache)
                    <div class="bg-white dark:bg-gray-700 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-600 cursor-pointer hover:shadow-md transition-shadow">
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
                                <button onclick="confirmDeleteTask({{ $tache->id }}, '{{ $tache->title }}')" class="text-gray-400 hover:text-red-600 dark:hover:text-red-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <h4 class="font-medium text-gray-900 dark:text-white mb-2">{{ $tache->title }}</h4>
                        
                        @if($tache->description)
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">{{ Str::limit($tache->description, 100) }}</p>
                        @endif
                        
                        @if($tache->deadline)
                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($tache->deadline)->format('d/m/Y H:i') }}
                                @if($tache->deadline < now() && $tache->status != 'terminé')
                                    <span class="ml-2 text-red-600 font-medium">En retard</span>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <p>Aucune tâche à faire</p>
                </div>
            @endif
        </div>
    </div>

    <!-- En Cours Column -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-gray-900 dark:text-white flex items-center">
                    <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>
                    {{ __('En Cours') }}
                    <span class="ml-2 text-xs text-gray-500">({{ $tachesEnCours->count() }})</span>
                </h3>
                <button id="addTaskEnCours" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <div id="formEnCours" class="hidden p-4 border-b border-gray-200 dark:border-gray-700">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="space-y-3">
                    <div>
                        <input 
                            type="text" 
                            name="title" 
                            placeholder="Titre de la tâche..." 
                            required
                            class="w-full px-3 py-2 border border-blue-300 dark:border-blue-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white text-sm"
                        >
                    </div>
                    
                    <div>
                        <textarea 
                            name="description" 
                            placeholder="Description..." 
                            rows="2"
                            class="w-full px-3 py-2 border border-blue-300 dark:border-blue-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white text-sm resize-none"
                        ></textarea>
                    </div>
                    
                    <div>
                        <input 
                            type="datetime-local" 
                            name="deadline" 
                            class="w-full px-3 py-2 border border-blue-300 dark:border-blue-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white text-sm"
                        >
                    </div>
                    
                    <div>
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
                    
                    <input type="hidden" name="status" value="en_cours">
                    
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
                                <button onclick="confirmDeleteTask({{ $tache->id }}, '{{ $tache->title }}')" class="text-gray-400 hover:text-red-600 dark:hover:text-red-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <h4 class="font-medium text-gray-900 dark:text-white mb-2">{{ $tache->title }}</h4>
                        
                        @if($tache->description)
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">{{ Str::limit($tache->description, 100) }}</p>
                        @endif
                        
                        @if($tache->deadline)
                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($tache->deadline)->format('d/m/Y H:i') }}
                                @if($tache->deadline < now() && $tache->status != 'terminé')
                                    <span class="ml-2 text-red-600 font-medium">En retard</span>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <p>Aucune tâche en cours</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Terminées Column -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-gray-900 dark:text-white flex items-center">
                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>
                    {{ __('Terminées') }}
                    <span class="ml-2 text-xs text-gray-500">({{ $tachesTerminees->count() }})</span>
                </h3>
                <button id="addTaskTerminees" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <div id="formTerminees" class="hidden p-4 border-b border-gray-200 dark:border-gray-700">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="space-y-3">
                    <div>
                        <input 
                            type="text" 
                            name="title" 
                            placeholder="Titre de la tâche..." 
                            required
                            class="w-full px-3 py-2 border border-green-300 dark:border-green-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white text-sm"
                        >
                    </div>
                    
                    <div>
                        <textarea 
                            name="description" 
                            placeholder="Description..." 
                            rows="2"
                            class="w-full px-3 py-2 border border-green-300 dark:border-green-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white text-sm resize-none"
                        ></textarea>
                    </div>
                    
                    <div>
                        <input 
                            type="datetime-local" 
                            name="deadline" 
                            class="w-full px-3 py-2 border border-green-300 dark:border-green-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white text-sm"
                        >
                    </div>
                    
                    <div>
                        <select 
                            name="priority" 
                            required
                            class="w-full px-3 py-2 border border-green-300 dark:border-green-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white text-sm"
                        >
                            <option value="">Priorité</option>
                            <option value="basse">Basse</option>
                            <option value="moyenne" selected>Moyenne</option>
                            <option value="haute">Haute</option>
                        </select>
                    </div>
                    
                    <input type="hidden" name="status" value="terminé">
                    
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="cancelFormTerminees()" class="px-3 py-1 text-sm border border-green-300 dark:border-green-600 text-green-700 dark:text-green-300 rounded hover:bg-green-50 dark:hover:bg-green-900">
                            Annuler
                        </button>
                        <button type="submit" class="px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700">
                            Ajouter
                        </button>
                    </div>
                </div>
            </form>
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
                                <button onclick="confirmDeleteTask({{ $tache->id }}, '{{ $tache->title }}')" class="text-gray-400 hover:text-red-600 dark:hover:text-red-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <h4 class="font-medium text-gray-900 dark:text-white mb-2 line-through">{{ $tache->title }}</h4>
                        
                        @if($tache->description)
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">{{ Str::limit($tache->description, 100) }}</p>
                        @endif
                        
                        @if($tache->deadline)
                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($tache->deadline)->format('d/m/Y H:i') }}
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p>Aucune tâche terminée</p>
                </div>
            @endif
        </div>
    </div>
</div>
