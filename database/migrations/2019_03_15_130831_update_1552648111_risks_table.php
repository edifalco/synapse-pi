<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552648111RisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risks', function (Blueprint $table) {
            if(Schema::hasColumn('risks', 'type')) {
                $table->dropColumn('type');
            }
            if(Schema::hasColumn('risks', 'triggerevents')) {
                $table->dropColumn('triggerevents');
            }
            
        });
Schema::table('risks', function (Blueprint $table) {
            
if (!Schema::hasColumn('risks', 'trigger_events')) {
                $table->text('trigger_events')->nullable();
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
            $table->dropColumn('trigger_events');
            
        });
Schema::table('risks', function (Blueprint $table) {
                        $table->integer('type')->nullable();
                $table->text('triggerevents');
                
        });

    }
}
