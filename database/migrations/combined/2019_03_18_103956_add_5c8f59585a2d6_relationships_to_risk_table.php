<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8f59585a2d6RelationshipsToRiskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risks', function(Blueprint $table) {
            if (!Schema::hasColumn('risks', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274866_5c813842a9f84')->references('id')->on('projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('risks', 'type_id')) {
                $table->integer('type_id')->unsigned()->nullable();
                $table->foreign('type_id', '274866_5c8b949b45e40')->references('id')->on('risk_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('risks', 'impact_id')) {
                $table->integer('impact_id')->unsigned()->nullable();
                $table->foreign('impact_id', '274866_5c8b949b5dd56')->references('id')->on('risk_impacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('risks', 'probability_id')) {
                $table->integer('probability_id')->unsigned()->nullable();
                $table->foreign('probability_id', '274866_5c8b949b76460')->references('id')->on('risk_probabilities')->onDelete('cascade');
                }
                if (!Schema::hasColumn('risks', 'proximity_id')) {
                $table->integer('proximity_id')->unsigned()->nullable();
                $table->foreign('proximity_id', '274866_5c8b949b909ce')->references('id')->on('risk_proximities')->onDelete('cascade');
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
        Schema::table('risks', function(Blueprint $table) {
            if(Schema::hasColumn('risks', 'project_id')) {
                $table->dropForeign('274866_5c813842a9f84');
                $table->dropIndex('274866_5c813842a9f84');
                $table->dropColumn('project_id');
            }
            if(Schema::hasColumn('risks', 'type_id')) {
                $table->dropForeign('274866_5c8b949b45e40');
                $table->dropIndex('274866_5c8b949b45e40');
                $table->dropColumn('type_id');
            }
            if(Schema::hasColumn('risks', 'impact_id')) {
                $table->dropForeign('274866_5c8b949b5dd56');
                $table->dropIndex('274866_5c8b949b5dd56');
                $table->dropColumn('impact_id');
            }
            if(Schema::hasColumn('risks', 'probability_id')) {
                $table->dropForeign('274866_5c8b949b76460');
                $table->dropIndex('274866_5c8b949b76460');
                $table->dropColumn('probability_id');
            }
            if(Schema::hasColumn('risks', 'proximity_id')) {
                $table->dropForeign('274866_5c8b949b909ce');
                $table->dropIndex('274866_5c8b949b909ce');
                $table->dropColumn('proximity_id');
            }
            
        });
    }
}
