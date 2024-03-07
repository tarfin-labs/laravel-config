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
        $tableName = config('laravel-config.table');

        Schema::table($tableName, function () use($tableName): void {
            DB::statement("ALTER TABLE $tableName CHANGE type type varchar(255) DEFAULT 'boolean' NOT NULL");        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableName = config('laravel-config.table');

        Schema::table($tableName, function () use($tableName): void {
            DB::statement("ALTER TABLE $tableName CHANGE type type ENUM('boolean','text') DEFAULT 'boolean' NOT NULL ");
        });
    }
}
