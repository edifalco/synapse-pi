<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c81387e30357RelationshipsToAcronymProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acronym_projects', function(Blueprint $table) {
            if (!Schema::hasColumn('acronym_projects', 'acronym_id')) {
                $table->integer('acronym_id')->unsigned()->nullable();
                $table->foreign('acronym_id', '274822_5c81382e45e62')->references('id')->on('acronyms')->onDelete('cascade');
                }
                if (!Schema::hasColumn('acronym_projects', 'partner_id')) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', '274822_5c81382e6f1fe')->references('id')->on('partners')->onDelete('cascade');
                }
                if (!Schema::hasColumn('acronym_projects', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274822_5c81382e9814e')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('acronym_projects', function(Blueprint $table) {
            
        });
    }
}
