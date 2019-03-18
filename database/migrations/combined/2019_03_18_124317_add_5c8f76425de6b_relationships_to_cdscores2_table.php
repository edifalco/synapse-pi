<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8f76425de6bRelationshipsToCdScores2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cd_scores2s', function(Blueprint $table) {
            if (!Schema::hasColumn('cd_scores2s', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274832_5c813831c9c9a')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('cd_scores2s', function(Blueprint $table) {
            if(Schema::hasColumn('cd_scores2s', 'project_id')) {
                $table->dropForeign('274832_5c813831c9c9a');
                $table->dropIndex('274832_5c813831c9c9a');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
