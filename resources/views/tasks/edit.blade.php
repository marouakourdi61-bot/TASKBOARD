<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Modifier la tâche
            </h2>
            <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                Retour à la liste
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Titre -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Titre <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            required
                            value="{{ old('title', $task->title) }}"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                            placeholder="Entrez le titre de la tâche"
                        >
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description
                        </label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="4"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                            placeholder="Décrivez votre tâche (optionnel)"
                        >{{ old('description', $task->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Deadline -->
                        <div class="mb-6">
                            <label for="deadline" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Date limite
                            </label>
                            <input 
                                type="date" 
                                id="deadline" 
                                name="deadline"
                                value="{{ old('deadline', $task->deadline ? $task->deadline->format('Y-m-d') : '') }}"
                                min="{{ now()->format('Y-m-d') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                            >
                            @error('deadline')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Priorité -->
                        <div class="mb-6">
                            <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Priorité <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="priority" 
                                name="priority"
                                required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">Choisir une priorité</option>
                                <option value="basse" {{ old('priority', $task->priority) == 'basse' ? 'selected' : '' }}>Basse</option>
                                <option value="moyenne" {{ old('priority', $task->priority) == 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                                <option value="haute" {{ old('priority', $task->priority) == 'haute' ? 'selected' : '' }}>Haute</option>
                            </select>
                            @error('priority')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Statut -->
                    <div class="mb-6">
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Statut
                        </label>
                        <select 
                            id="status" 
                            name="status"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                        >
                            <option value="à_faire" {{ old('status', $task->status) == 'à_faire' ? 'selected' : '' }}>À Faire</option>
                            <option value="en_cours" {{ old('status', $task->status) == 'en_cours' ? 'selected' : '' }}>En Cours</option>
                            <option value="en_revue" {{ old('status', $task->status) == 'en_revue' ? 'selected' : '' }}>En Revue</option>
                            <option value="terminé" {{ old('status', $task->status) == 'terminé' ? 'selected' : '' }}>Terminé</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Informations sur la tâche -->
                    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Informations actuelles</h4>
                        <div class="text-xs text-gray-600 dark:text-gray-400 space-y-1">
                            <p><strong>Créée le :</strong> {{ $task->created_at->format('d/m/Y à H:i') }}</p>
                            <p><strong>Dernière modification :</strong> {{ $task->updated_at->format('d/m/Y à H:i') }}</p>
                            @if($task->deadline)
                                <p><strong>Deadline actuelle :</strong> {{ $task->deadline->format('d/m/Y') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('tasks.index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            Annuler
                        </a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-black rounded-lg hover:bg-indigo-700 transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
