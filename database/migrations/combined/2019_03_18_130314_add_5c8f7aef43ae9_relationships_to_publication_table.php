<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8f7aef43ae9RelationshipsToPublicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publications', function(Blueprint $table) {
            if (!Schema::hasColumn('publications', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274860_5c81383f73c18')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('publications', function(Blueprint $table) {
            if(Schema::hasColumn('publications', 'project_id')) {
                $table->dropForeign('274860_5c81383f73c18');
                $table->dropIndex('274860_5c81383f73c18');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
