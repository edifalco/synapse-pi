<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c813f4d056b9RelationshipsToMetriclabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('metriclabels', function(Blueprint $table) {
            if (!Schema::hasColumn('metriclabels', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274850_5c81383aea31d')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('metriclabels', function(Blueprint $table) {
            if(Schema::hasColumn('metriclabels', 'project_id')) {
                $table->dropForeign('274850_5c81383aea31d');
                $table->dropIndex('274850_5c81383aea31d');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
