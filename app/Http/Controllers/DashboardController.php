<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupérer le terme de recherche
        $search = request('search');
        
        // Base query pour les tâches de l'utilisateur
        $baseQuery = Task::whereNull('deleted_at')
                        ->where('user_id', auth()->id());
        
        // Appliquer la recherche si un terme est fourni
        if ($search) {
            $baseQuery->where(function($query) use ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                      ->orWhere('description', 'LIKE', '%' . $search . '%');
            });
        }
        
        // Récupérer les tâches par statut
        $tachesAFaire = (clone $baseQuery)
                       ->where('status', 'à_faire')
                       ->orderBy('created_at', 'desc')
                       ->get();
        
        $tachesEnCours = (clone $baseQuery)
                       ->where('status', 'en_cours')
                       ->orderBy('created_at', 'desc')
                       ->get();
        
        $tachesTerminees = (clone $baseQuery)
                         ->where('status', 'terminé')
                         ->orderBy('created_at', 'desc')
                         ->get();
        
        // Calculer les statistiques
        $allTasks = Task::whereNull('deleted_at')
                        ->where('user_id', auth()->id())
                        ->get();
        
        $totalTasks = $allTasks->count();
        $todoTasks = $allTasks->where('status', 'à_faire')->count();
        $inProgressTasks = $allTasks->where('status', 'en_cours')->count();
        $completedTasks = $allTasks->where('status', 'terminé')->count();
        
        // Tâches en retard
        $overdueTasks = $allTasks->where('deadline', '<', now())
                             ->where('status', '!=', 'terminé')
                             ->count();
        
        // Pourcentage de complétion
        $completionPercentage = $totalTasks > 0 
            ? round(($completedTasks / $totalTasks) * 100, 1) 
            : 0;
        
        return view('dashboard', compact(
            'tachesAFaire', 
            'tachesEnCours', 
            'tachesTerminees',
            'totalTasks',
            'todoTasks',
            'inProgressTasks',
            'completedTasks',
            'overdueTasks',
            'completionPercentage'
        ));
    }
}
