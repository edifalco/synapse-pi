<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8242f62fee0RelationshipsToPartnernumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partnernums', function(Blueprint $table) {
            if (!Schema::hasColumn('partnernums', 'partner_id')) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', '274851_5c81383b4735d')->references('id')->on('partners')->onDelete('cascade');
                }
                if (!Schema::hasColumn('partnernums', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274851_5c81383b75523')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('partnernums', function(Blueprint $table) {
            
        });
    }
}
