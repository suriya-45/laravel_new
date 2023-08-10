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
        Schema::table('users',function($table){
            $table->bigInteger("phone")->nullable();
            $table->string("role")->nullable()->comment('admin','agent','user');
            $table->string('google_id')->nullable();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('users',function($table){
        $table->dropColumn('phone');
        $table->dropColumn('role');
        $table->dropColumn('google_id');
       });

    }
};
