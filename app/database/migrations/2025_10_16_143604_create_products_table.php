<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('shopping_list_id')->constrained()->cascadeOnDelete();
        $table->string('name');
        $table->string('emoji')->nullable();
        $table->unsignedInteger('quantity')->default(1);
        $table->timestamps();
        $table->unique(['shopping_list_id','name','emoji']);
    });
}
public function down(): void
{
    Schema::dropIfExists('products');
}


};
