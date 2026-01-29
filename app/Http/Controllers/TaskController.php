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




    

    
    public function create()
    {
        return view('tasks.create');
    }

    //creation
    public function store(Request $request)
    {
        try {
            // Validation 
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'deadline' => 'nullable|date|after_or_equal:today',
                'priority' => 'required|in:basse,moyenne,haute',
                'status' => 'required|in:à_faire,en_cours,en_revue,terminé',
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

    //modifier 
    public function edit(string $id)
    {
        //
    }

   //modifier
    public function update(Request $request, string $id)
    {
        //
    }

    //suprimer
    public function destroy(string $id)
    {
        //
    }
}
