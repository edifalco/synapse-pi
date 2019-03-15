<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8b9012dff99RelationshipsToRiskTable extends Migration
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
                if (!Schema::hasColumn('risks', 'risks_type_id')) {
                $table->integer('risks_type_id')->unsigned()->nullable();
                $table->foreign('risks_type_id', '274866_5c8b87af54a67')->references('id')->on('risk_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('risks', 'risk_impact_id')) {
                $table->integer('risk_impact_id')->unsigned()->nullable();
                $table->foreign('risk_impact_id', '274866_5c8b8d1290760')->references('id')->on('risk_impacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('risks', 'risk_probabilities_id')) {
                $table->integer('risk_probabilities_id')->unsigned()->nullable();
                $table->foreign('risk_probabilities_id', '274866_5c8b8d12ac7d4')->references('id')->on('risk_probabilities')->onDelete('cascade');
                }
                if (!Schema::hasColumn('risks', 'risk_proximity_id')) {
                $table->integer('risk_proximity_id')->unsigned()->nullable();
                $table->foreign('risk_proximity_id', '274866_5c8b900be48e7')->references('id')->on('risk_proximities')->onDelete('cascade');
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
            if(Schema::hasColumn('risks', 'risks_type_id')) {
                $table->dropForeign('274866_5c8b87af54a67');
                $table->dropIndex('274866_5c8b87af54a67');
                $table->dropColumn('risks_type_id');
            }
            if(Schema::hasColumn('risks', 'risk_impact_id')) {
                $table->dropForeign('274866_5c8b8d1290760');
                $table->dropIndex('274866_5c8b8d1290760');
                $table->dropColumn('risk_impact_id');
            }
            if(Schema::hasColumn('risks', 'risk_probabilities_id')) {
                $table->dropForeign('274866_5c8b8d12ac7d4');
                $table->dropIndex('274866_5c8b8d12ac7d4');
                $table->dropColumn('risk_probabilities_id');
            }
            if(Schema::hasColumn('risks', 'risk_proximity_id')) {
                $table->dropForeign('274866_5c8b900be48e7');
                $table->dropIndex('274866_5c8b900be48e7');
                $table->dropColumn('risk_proximity_id');
            }
            
        });
    }
}
