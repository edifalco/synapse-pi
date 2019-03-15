<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552652677RisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risks', function (Blueprint $table) {
            if(Schema::hasColumn('risks', 'owner_id')) {
                $table->dropForeign('274866_5c8b949bac863');
                $table->dropIndex('274866_5c8b949bac863');
                $table->dropColumn('owner_id');
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
        Schema::table('risks', function (Blueprint $table) {
                        
        });

    }
}
