<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8a245b2bc65RelationshipsToAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agendas', function(Blueprint $table) {
            if (!Schema::hasColumn('agendas', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274824_5c81382f60b1f')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('agendas', function(Blueprint $table) {
            if(Schema::hasColumn('agendas', 'project_id')) {
                $table->dropForeign('274824_5c81382f60b1f');
                $table->dropIndex('274824_5c81382f60b1f');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
