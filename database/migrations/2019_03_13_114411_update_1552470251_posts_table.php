<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552470251PostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            if(Schema::hasColumn('posts', 'idUser_id')) {
                $table->dropForeign('274855_5c81383cc3167');
                $table->dropIndex('274855_5c81383cc3167');
                $table->dropColumn('idUser_id');
            }
            if(Schema::hasColumn('posts', 'idProject_id')) {
                $table->dropForeign('274855_5c81383cedbdc');
                $table->dropIndex('274855_5c81383cedbdc');
                $table->dropColumn('idProject_id');
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
        Schema::table('posts', function (Blueprint $table) {
                        
        });

    }
}
