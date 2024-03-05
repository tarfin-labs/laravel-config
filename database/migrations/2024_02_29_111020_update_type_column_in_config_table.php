<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTypeColumnInConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table(config('laravel-config.table'), function (Blueprint $table) {
            $table->string('type')->nullable(false)->default('boolean')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table(config('laravel-config.table'), function (Blueprint $table) {
            $table->enum('type', ['boolean', 'text'])->nullable()->default('boolean')->change();
        });
    }
}
