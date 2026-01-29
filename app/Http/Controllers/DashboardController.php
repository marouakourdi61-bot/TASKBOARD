<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupérer les tâches de l'utilisateur connecté par statut
        $tachesAFaire = Task::whereNull('deleted_at')
                           ->where('user_id', auth()->id())
                           ->where('status', 'à_faire')
                           ->orderBy('created_at', 'desc')
                           ->get();
        
        $tachesEnCours = Task::whereNull('deleted_at')
                           ->where('user_id', auth()->id())
                           ->where('status', 'en_cours')
                           ->orderBy('created_at', 'desc')
                           ->get();
        
        $tachesTerminees = Task::whereNull('deleted_at')
                             ->where('user_id', auth()->id())
                             ->where('status', 'terminé')
                             ->orderBy('created_at', 'desc')
                             ->get();
        
        return view('dashboard', compact('tachesAFaire', 'tachesEnCours', 'tachesTerminees'));
    }
}
