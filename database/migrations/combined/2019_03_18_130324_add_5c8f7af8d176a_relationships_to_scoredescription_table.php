<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8f7af8d176aRelationshipsToScoredescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scoredescriptions', function(Blueprint $table) {
            if (!Schema::hasColumn('scoredescriptions', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274868_5c81384346568')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('scoredescriptions', function(Blueprint $table) {
            if(Schema::hasColumn('scoredescriptions', 'project_id')) {
                $table->dropForeign('274868_5c81384346568');
                $table->dropIndex('274868_5c81384346568');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
