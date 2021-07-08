<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $tableName = config('laravel-config.table');
        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->enum('type', ['boolean', 'text'])->default('boolean');
            $table->string('val')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(config('laravel-config.table'));
    }
}
