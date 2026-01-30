<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    



    public function index()
    {
        //  les taches de l'utilisateur connecté avec pagination
        $query = Task::whereNull('deleted_at') 
                    ->where('user_id', auth()->id()); 
        
        $taches = $query->orderBy('created_at', 'desc')
                       ->paginate(10);
        
        return view('tasks.index', compact('taches'));
    }




    

    //afiche le formulaire de creation
    public function create()
    {
        return view('tasks.create');
    }

    
    public function store(Request $request)
    {
        try {
            // Validation 
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'deadline' => 'nullable|date|after_or_equal:today',
                'priority' => 'required|in:basse,moyenne,haute',
                'status' => 'required|in:à_faire,en_cours,terminé',
            ]);

            // Création avec propriétai
            $task = Task::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'deadline' => $validated['deadline'],
                'priority' => $validated['priority'],
                'status' => $validated['status'], 
                'user_id' => auth()->id(), 
            ]);

            // Message succès  
            return redirect()
                ->route('dashboard')
                ->with('success', 'Tâche créée avec succès!');
                
        }
         //  message d'erreur
         catch (\Exception $e) {
            return redirect()
                ->route('dashboard')
                ->with('error', 'Erreur lors de la création: ' . $e->getMessage());
        }
    }





    
    //afficher resource
    public function show(string $id)
    {
        //
    }
    //edit
    public function edit(Task $task)
    {
        // Vérification que l'utilisateur est propriétaire
        if ($task->user_id !== auth()->id()) {
            return redirect()
                ->route('tasks.index')
                ->with('error', 'Vous n\'êtes pas autorisé à modifier cette tâche.');
        }
        
        return view('tasks.edit', compact('task'));
    }

    //update
    public function update(Request $request, Task $task)
    {
        // Vérification que l'utilisateur est propriétaire
        if ($task->user_id !== auth()->id()) {
            return redirect()
                ->route('tasks.index')
                ->with('error', 'Vous n\'êtes pas autorisé à modifier cette tâche.');
        }

        try {
            // Validation des données
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'deadline' => 'nullable|date|after_or_equal:today',
                'priority' => 'required|in:basse,moyenne,haute',
                'status' => 'required|in:à_faire,en_cours,terminé',
            ]);

            // Mise à jour de la tâche
            $task->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'deadline' => $validated['deadline'],
                'priority' => $validated['priority'],
                'status' => $validated['status'],
            ]);

            // Message succee et redirection
            return redirect()
                ->route('tasks.index')
                ->with('success', 'Tâche mise à jour avec succès!');
                
        } catch (\Exception $e) {
            // En cas d'erreur, rediriger avec message d'erreur
            return redirect()
                ->route('tasks.index')
                ->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage());
        }
    }

    //updatae avec ajax
    public function updateStatus(Request $request, Task $task)
    {
        // Vérification que l'utilisateur est propriétaire
        if ($task->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Vous n\'êtes pas autorisé à modifier cette tâche.'
            ], 403);
        }

        try {
            // Validation du statut
            $validated = $request->validate([
                'status' => 'required|in:à_faire,en_cours,terminé',
            ]);

            // Mise à jour du statut
            $task->update([
                'status' => $validated['status'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Statut mis à jour avec succès!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour: ' . $e->getMessage()
            ], 500);
        }
    }

    


    
    public function destroy(Task $task)
    {
        // Vérification que l'utilisateur est propriétaire
        if ($task->user_id !== auth()->id()) {
            return redirect()
                ->route('tasks.index')
                ->with('error', 'Vous n\'êtes pas autorisé à supprimer cette tâche.');
        }

        try {
            // Soft delete : archiver la tâche
            $task->delete();
            
            // message de succès
            return redirect()
                ->route('tasks.index')
                ->with('success', 'Tâche supprimée avec succès!');
                
        } catch (\Exception $e) {
            // message d'erreur
            return redirect()
                ->route('tasks.index')
                ->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }
}
