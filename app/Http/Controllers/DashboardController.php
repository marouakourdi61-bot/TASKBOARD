<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        
        // Récupérer les filtres
        $search = request('search');
        $priority = request('priority');
        $status = request('status');
        $deadlineSort = request('deadline_sort', 'desc');
        
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
        
        // Appliquer le filtre de priorité si une priorité est fournie
        if ($priority) {
            $baseQuery->where('priority', $priority);
        }
        
        // Appliquer le filtre de statut si un statut est fourni
        if ($status) {
            $baseQuery->where('status', $status);
        }
        
        // Définir l'ordre de tri par deadline
        $deadlineOrder = $deadlineSort == 'asc' ? 'asc' : 'desc';
        $nullOrder = $deadlineSort == 'asc' ? 'asc' : 'desc'; 
        
        // Récupérer tâches par statu

        if ($status) {
            // Si un filtre de statut est appliqué ne requper que ce statut
            if ($status == 'à_faire') {
                $tachesAFaire = $baseQuery->orderByRaw("ISNULL(deadline) $nullOrder, deadline $deadlineOrder")->get();
                $tachesEnCours = collect([]);
                $tachesTerminees = collect([]);
            } elseif ($status == 'en_cours') {
                $tachesAFaire = collect([]);
                $tachesEnCours = $baseQuery->orderByRaw("ISNULL(deadline) $nullOrder, deadline $deadlineOrder")->get();
                $tachesTerminees = collect([]);
            } elseif ($status == 'terminé') {
                $tachesAFaire = collect([]);
                $tachesEnCours = collect([]);
                $tachesTerminees = $baseQuery->orderByRaw("ISNULL(deadline) $nullOrder, deadline $deadlineOrder")->get();
            }
        } else {
            // Si aucun filtre, récupérer tous les statuts
            $tachesAFaire = (clone $baseQuery)
                           ->where('status', 'à_faire')
                           ->orderByRaw("ISNULL(deadline) $nullOrder, deadline $deadlineOrder")
                           ->get();
            
            $tachesEnCours = (clone $baseQuery)
                           ->where('status', 'en_cours')
                           ->orderByRaw("ISNULL(deadline) $nullOrder, deadline $deadlineOrder")
                           ->get();
            
            $tachesTerminees = (clone $baseQuery)
                             ->where('status', 'terminé')
                             ->orderByRaw("ISNULL(deadline) $nullOrder, deadline $deadlineOrder")
                             ->get();
        }
        
        // Calculer les statistiques
        $allTasks = Task::whereNull('deleted_at')
                        ->where('user_id', auth()->id())
                        ->get();
        
        $totalTasks = $allTasks->count();
        $todoTasks = $allTasks->where('status', 'à_faire')->count();
        $inProgressTasks = $allTasks->where('status', 'en_cours')->count();
        $completedTasks = $allTasks->where('status', 'terminé')->count();
        
        // Taches retard
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

    /**
     * AJAX search method for dashboard
     */
    public function search(Request $request)
    {
        // Récupérer la recherche
        $search = $request->get('search');
        
        // Base query pour les tâches de l'utilisateur
        $baseQuery = Task::whereNull('deleted_at')
                        ->where('user_id', auth()->id());
        
        // Appliquer la recherche si un terme est fourni
        if ($search) {
            $baseQuery->where(function($query) use ($search) {
                // Recherche les mots qui commencent par la lettre/terme tapé
                $query->where('title', 'LIKE', $search . '%')
                      ->orWhere('title', 'LIKE', '% ' . $search . '%') // Après un espace
                      ->orWhere('description', 'LIKE', $search . '%')
                      ->orWhere('description', 'LIKE', '% ' . $search . '%'); // Après un espace
            });
        }
        
        // Récupérer les filtres de la requête principale
        $status = request('status');
        $priority = request('priority');
        $deadlineSort = request('deadline_sort', 'desc');
        
        // Appliquer les filtres de la requête principale
        if ($priority) {
            $baseQuery->where('priority', $priority);
        }
        
        if ($status) {
            $baseQuery->where('status', $status);
        }
        
        // Définir l'ordre de tri par deadline
        $deadlineOrder = $deadlineSort == 'asc' ? 'asc' : 'desc';
        $nullOrder = $deadlineSort == 'asc' ? 'asc' : 'desc';
        
        // Récupérer les tâches par statut
        if ($status) {
            // Si un filtre de statut est appliqué, ne récupérer que ce statut
            if ($status == 'à_faire') {
                $tachesAFaire = $baseQuery->orderByRaw("ISNULL(deadline) $nullOrder, deadline $deadlineOrder")->get();
                $tachesEnCours = collect([]);
                $tachesTerminees = collect([]);
            } elseif ($status == 'en_cours') {
                $tachesAFaire = collect([]);
                $tachesEnCours = $baseQuery->orderByRaw("ISNULL(deadline) $nullOrder, deadline $deadlineOrder")->get();
                $tachesTerminees = collect([]);
            } elseif ($status == 'terminé') {
                $tachesAFaire = collect([]);
                $tachesEnCours = collect([]);
                $tachesTerminees = $baseQuery->orderByRaw("ISNULL(deadline) $nullOrder, deadline $deadlineOrder")->get();
            }
        } else {
            // Si aucun filtre, récupérer tous les statuts
            $tachesAFaire = (clone $baseQuery)
                           ->where('status', 'à_faire')
                           ->orderByRaw("ISNULL(deadline) $nullOrder, deadline $deadlineOrder")
                           ->get();
            
            $tachesEnCours = (clone $baseQuery)
                           ->where('status', 'en_cours')
                           ->orderByRaw("ISNULL(deadline) $nullOrder, deadline $deadlineOrder")
                           ->get();
            
            $tachesTerminees = (clone $baseQuery)
                             ->where('status', 'terminé')
                             ->orderByRaw("ISNULL(deadline) $nullOrder, deadline $deadlineOrder")
                             ->get();
        }
        
        // Calculer les statistiques
        $allTasks = Task::whereNull('deleted_at')
                        ->where('user_id', auth()->id())
                        ->get();
        
        $totalTasks = $allTasks->count();
        $todoTasks = $allTasks->where('status', 'à_faire')->count();
        $inProgressTasks = $allTasks->where('status', 'en_cours')->count();
        $completedTasks = $allTasks->where('status', 'terminé')->count();
        
        // Taches retard
        $overdueTasks = $allTasks->where('deadline', '<', now())
                             ->where('status', '!=', 'terminé')
                             ->count();
        
        // Pourcentage de complétion
        $completionPercentage = $totalTasks > 0 
            ? round(($completedTasks / $totalTasks) * 100, 1) 
            : 0;
        
        // Return only the kanban board HTML for AJAX
        return view('partials.kanban-board', compact('tachesAFaire', 'tachesEnCours', 'tachesTerminees', 'totalTasks', 'todoTasks', 'inProgressTasks', 'completedTasks', 'overdueTasks', 'completionPercentage'));
    }
}
