<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c867b4b1916aRelationshipsToProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function(Blueprint $table) {
            if (!Schema::hasColumn('projects', 'partners_id')) {
                $table->integer('partners_id')->unsigned()->nullable();
                $table->foreign('partners_id', '274859_5c867b4784c0c')->references('id')->on('partners')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function(Blueprint $table) {
            
        });
    }
}
