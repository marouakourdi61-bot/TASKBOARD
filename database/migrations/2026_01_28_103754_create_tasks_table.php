<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
      //Run the migrations.
    
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('deadline')->nullable();
            $table->enum('priority', ['basse', 'moyenne', 'haute'])->default('moyenne');
            $table->enum('status', ['à_faire', 'en_cours', 'en_revue', 'terminé'])->default('à_faire');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    //Reversé la migration.

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
