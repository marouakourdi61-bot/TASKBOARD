<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Mes Tâches
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Messages de succès/erreur -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-6 bg-red-50 dark:bg-red-900 border border-red-200 dark:border-red-700 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <!-- Header -->
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                            Mes Tâches
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                            Liste de toutes vos tâches actives
                        </p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Ajouter une tâche
                        </a>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $taches->count() }} tâche(s) • Page {{ $taches->currentPage() }} sur {{ $taches->lastPage() }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Table des tâches -->
            <div class="overflow-x-auto">
                @if($taches->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Titre
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Deadline
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Priorité
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($taches as $tache)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $tache->title }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ $tache->description ? Str::limit($tache->description, 100) : '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ $tache->deadline ? $tache->deadline->format('d/m/Y') : '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            @if($tache->priority == 'haute')
                                                bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                            @elseif($tache->priority == 'moyenne')
                                                bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                            @else
                                                bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                            @endif">
                                            {{ ucfirst($tache->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            @if($tache->status == 'terminé')
                                                bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                            @elseif($tache->status == 'en_cours')
                                                bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                            @elseif($tache->status == 'en_revue')
                                                bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                            @else
                                                bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200
                                            @endif">
                                            {{ str_replace('_', ' ', ucfirst($tache->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('tasks.edit', $tache->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">
                                            Modifier
                                        </a>
                                        <button 
                                            onclick="confirmDeleteTask({{ $tache->id }}, '{{ $tache->title }}')"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                        >
                                            Supprimer
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <!-- Message si aucune tâche -->
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Aucune tâche</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Commencez par créer votre première tâche.</p>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($taches->hasPages())
                <div class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 flex justify-between sm:hidden">
                            {{ $taches->links() }}
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700 dark:text-gray-300">
                                    Affichage de
                                    <span class="font-medium">{{ $taches->firstItem() }}</span>
                                    à
                                    <span class="font-medium">{{ $taches->lastItem() }}</span>
                                    sur
                                    <span class="font-medium">{{ $taches->total() }}</span>
                                    résultats
                                </p>
                            </div>
                            <div>
                                {{ $taches->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
</x-app-layout>

<script>
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
</script>
