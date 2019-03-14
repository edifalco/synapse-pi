<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8a97ac9f3dbRelationshipsToPartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partners', function(Blueprint $table) {
            if (!Schema::hasColumn('partners', 'country_id')) {
                $table->integer('country_id')->unsigned()->nullable();
                $table->foreign('country_id', '274853_5c8a8a9b8adcd')->references('id')->on('countries')->onDelete('cascade');
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
        Schema::table('partners', function(Blueprint $table) {
            if(Schema::hasColumn('partners', 'country_id')) {
                $table->dropForeign('274853_5c8a8a9b8adcd');
                $table->dropIndex('274853_5c8a8a9b8adcd');
                $table->dropColumn('country_id');
            }
            
        });
    }
}
