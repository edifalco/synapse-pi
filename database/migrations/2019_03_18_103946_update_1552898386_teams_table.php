<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552898386TeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            if(Schema::hasColumn('teams', 'partner_id')) {
                $table->dropForeign('278114_5c8bc5e1e20d7');
                $table->dropIndex('278114_5c8bc5e1e20d7');
                $table->dropColumn('partner_id');
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
        Schema::table('teams', function (Blueprint $table) {
                        
        });

    }
}
