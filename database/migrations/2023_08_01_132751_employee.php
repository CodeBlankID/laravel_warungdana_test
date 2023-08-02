<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Employee', function (Blueprint $table) {
            $table->id();
            $table->String("firstname");
            $table->String("lastname")->nullable();
            $table->Date("hiredate");
            $table->Date("terminationdate")->nullable();
            $table->String("salary");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Employee');
    }
};
