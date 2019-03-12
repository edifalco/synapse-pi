<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c861e1ea2e93RelationshipsToProjectPartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_partners', function(Blueprint $table) {
            if (!Schema::hasColumn('project_partners', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274857_5c81383e2ed4b')->references('id')->on('projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('project_partners', 'partner_id')) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', '274857_5c81383e5d444')->references('id')->on('partners')->onDelete('cascade');
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
        Schema::table('project_partners', function(Blueprint $table) {
            
        });
    }
}
