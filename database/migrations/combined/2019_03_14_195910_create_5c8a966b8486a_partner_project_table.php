<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c8a966b8486aPartnerProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('partner_project')) {
            Schema::create('partner_project', function (Blueprint $table) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', 'fk_p_274853_274859_projec_5c8a966b849e6')->references('id')->on('partners')->onDelete('cascade');
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', 'fk_p_274859_274853_partne_5c8a966b84a7e')->references('id')->on('projects')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_project');
    }
}