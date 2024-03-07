<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            DB::statement("ALTER TABLE laravel_config CHANGE type type varchar(255) DEFAULT 'boolean' NOT NULL");
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
            DB::statement("ALTER TABLE laravel_config CHANGE type type ENUM('boolean','text') DEFAULT 'boolean' NOT NULL ");
        });
    }
}
