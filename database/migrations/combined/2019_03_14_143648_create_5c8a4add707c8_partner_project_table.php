<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c8a4add707c8PartnerProjectTable extends Migration
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
                $table->foreign('partner_id', 'fk_p_274853_274859_projec_5c8a4add70a16')->references('id')->on('partners')->onDelete('cascade');
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', 'fk_p_274859_274853_partne_5c8a4add70b00')->references('id')->on('projects')->onDelete('cascade');
                
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