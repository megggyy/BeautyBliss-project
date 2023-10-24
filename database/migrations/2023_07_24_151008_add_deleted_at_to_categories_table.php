<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    // Add the `down` method if you want to rollback the migration
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
