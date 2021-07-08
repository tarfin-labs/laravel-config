<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTagsColumnToConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table(config('laravel-config.table'), function (Blueprint $table) {
            $table->json('tags')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $tableName = config('laravel-config.table');
        if (Schema::hasColumn($tableName, 'tags')){
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('tags');
            });
        }
    }
}
