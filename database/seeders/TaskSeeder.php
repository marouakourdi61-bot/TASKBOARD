<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // le premier utilisateur
        $user = User::first();
        
        if (!$user) {
            // Si aucun utilisateur n'existe, on en crée un
            $user = User::create([
                'name' => 'Utilisateur Test',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Créer taches  test
        $tasks = [
            [
                'title' => 'Optimiser les performances de la base de données',
                'description' => 'Analyser et optimiser les requêtes SQL lentes pour améliorer la vitesse de chargement',
                'deadline' => now()->addDays(5),
                'priority' => 'haute',
                'status' => 'à_faire',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Mettre à jour la documentation API',
                'description' => 'Documenter tous les endpoints REST avec exemples et schémas',
                'deadline' => now()->addDays(10),
                'priority' => 'moyenne',
                'status' => 'à_faire',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Développer le module d\'authentification',
                'description' => 'Implémenter OAuth2 et JWT pour l\'authentification sécurisée',
                'deadline' => now()->addDays(3),
                'priority' => 'haute',
                'status' => 'en_cours',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Créer les tests unitaires',
                'description' => 'Écrire des tests pour les fonctionnalités principales de l\'application',
                'deadline' => now()->addDays(7),
                'priority' => 'moyenne',
                'status' => 'en_cours',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Configuration de l\'environnement CI/CD',
                'description' => 'GitHub Actions configuré pour le déploiement automatique',
                'deadline' => now()->subDays(2),
                'priority' => 'basse',
                'status' => 'terminé',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Refactoriser le code legacy',
                'description' => 'Nettoyer et optimiser le code existant pour améliorer la maintenabilité',
                'deadline' => now()->addDays(14),
                'priority' => 'basse',
                'status' => 'terminé',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Implémenter le système de notifications',
                'description' => 'Ajouter des notifications par email et en temps réel',
                'deadline' => now()->addDays(8),
                'priority' => 'moyenne',
                'status' => 'en_revue',
                'user_id' => $user->id,
            ],
        ];

        // Insérer les taches dans la base de données
        foreach ($tasks as $task) {
            Task::create($task);
        }

        $this->command->info('Tâches de test créées avec succès!');
    }
}
