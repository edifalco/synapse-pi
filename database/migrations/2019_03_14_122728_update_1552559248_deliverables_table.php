<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552559248DeliverablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverables', function (Blueprint $table) {
            if(Schema::hasColumn('deliverables', 'workpackages_id')) {
                $table->dropForeign('274839_5c8a2902384b3');
                $table->dropIndex('274839_5c8a2902384b3');
                $table->dropColumn('workpackages_id');
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
