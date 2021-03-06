<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c813ad7c7988RelationshipsToEffortTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('efforts', function(Blueprint $table) {
            if (!Schema::hasColumn('efforts', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274842_5c81383703521')->references('id')->on('projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('efforts', 'workpackage_id')) {
                $table->integer('workpackage_id')->unsigned()->nullable();
                $table->foreign('workpackage_id', '274842_5c8138373bafd')->references('id')->on('workpackages')->onDelete('cascade');
                }
                if (!Schema::hasColumn('efforts', 'partner_id')) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', '274842_5c81383766490')->references('id')->on('partners')->onDelete('cascade');
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
        Schema::table('efforts', function(Blueprint $table) {
            
        });
    }
}
