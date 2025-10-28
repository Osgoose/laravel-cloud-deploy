<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('shopping_list_shares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shopping_list_id')->constrained('shopping_lists')->cascadeOnDelete();
            $table->string('email')->index();
            $table->timestamps();
            $table->unique(['shopping_list_id','email']); // evita duplicados
        });
    }
    public function down(): void {
        Schema::dropIfExists('shopping_list_shares');
    }
};
