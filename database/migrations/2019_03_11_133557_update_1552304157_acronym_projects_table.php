<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552304157AcronymProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acronym_projects', function (Blueprint $table) {
            if(Schema::hasColumn('acronym_projects', 'acronym_id')) {
                $table->dropForeign('274822_5c81382e45e62');
                $table->dropIndex('274822_5c81382e45e62');
                $table->dropColumn('acronym_id');
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
        Schema::table('acronym_projects', function (Blueprint $table) {
                        
        });

    }
}
