<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552645593SchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            if(Schema::hasColumn('schedules', 'status')) {
                $table->dropColumn('status');
            }
            if(Schema::hasColumn('schedules', 'highlight')) {
                $table->dropColumn('highlight');
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
        Schema::table('schedules', function (Blueprint $table) {
                        $table->string('status');
                $table->integer('highlight')->nullable();
                
        });

    }
}
