<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'priority',
        'status',
        'user_id',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    // Relation avec user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Méthode pour récupérer les tches 
    public function actives($query)
    {
        return $query->whereNull('deleted_at');
    }

    // Méthode pour les taches d'un utilisateur
    public function deUtilisateur($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
