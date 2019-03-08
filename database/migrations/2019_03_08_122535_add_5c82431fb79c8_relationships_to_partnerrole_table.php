<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c82431fb79c8RelationshipsToPartnerroleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partnerroles', function(Blueprint $table) {
            if (!Schema::hasColumn('partnerroles', 'partner_id')) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', '274852_5c81383bd9fc9')->references('id')->on('partners')->onDelete('cascade');
                }
                if (!Schema::hasColumn('partnerroles', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274852_5c81383c1484d')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('partnerroles', function(Blueprint $table) {
            
        });
    }
}
