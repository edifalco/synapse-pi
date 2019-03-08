<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c82a0dfea1ccRelationshipsToThresholdRiskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('threshold_risks', function(Blueprint $table) {
            if (!Schema::hasColumn('threshold_risks', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274870_5c813843ca066')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('threshold_risks', function(Blueprint $table) {
            if(Schema::hasColumn('threshold_risks', 'project_id')) {
                $table->dropForeign('274870_5c813843ca066');
                $table->dropIndex('274870_5c813843ca066');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
