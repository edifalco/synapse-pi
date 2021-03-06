<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8f7aefa4f8fRelationshipsToWorkpackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workpackages', function(Blueprint $table) {
            if (!Schema::hasColumn('workpackages', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274871_5c8138441d7c3')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('workpackages', function(Blueprint $table) {
            if(Schema::hasColumn('workpackages', 'project_id')) {
                $table->dropForeign('274871_5c8138441d7c3');
                $table->dropIndex('274871_5c8138441d7c3');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
