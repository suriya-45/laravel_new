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
            $table->string("username")->nullable()->before("password");
            $table->string("photo")->nullable();
            $table->string("role")->nullable()->comment('admin','agent','user');
            $table->string('google_id')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1->active,2->inacive,3->delete');


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
        $table->dropColumn('username');
        $table->dropColumn('photo');
        $table->dropColumn('status');


       });

    }
};
