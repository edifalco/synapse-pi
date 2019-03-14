<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8a2e021b9a9RelationshipsToRiskTable extends Migration
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
            
        });
    }
}
