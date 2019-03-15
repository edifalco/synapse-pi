<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552649490RisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risks', function (Blueprint $table) {
            if(Schema::hasColumn('risks', 'impact')) {
                $table->dropColumn('impact');
            }
            if(Schema::hasColumn('risks', 'probability')) {
                $table->dropColumn('probability');
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
                        $table->integer('impact')->nullable();
                $table->integer('probability')->nullable();
                
        });

    }
}
