<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552477948DeliverablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverables', function (Blueprint $table) {
            if(Schema::hasColumn('deliverables', 'idStatus_id')) {
                $table->dropForeign('274839_5c81383522cc2');
                $table->dropIndex('274839_5c81383522cc2');
                $table->dropColumn('idStatus_id');
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
        Schema::table('deliverables', function (Blueprint $table) {
                        
        });

    }
}
