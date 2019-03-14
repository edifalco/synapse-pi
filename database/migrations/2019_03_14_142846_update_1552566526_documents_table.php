<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552566526DocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            if(Schema::hasColumn('documents', 'document')) {
                $table->dropColumn('document');
            }
            
        });
Schema::table('documents', function (Blueprint $table) {
            
if (!Schema::hasColumn('documents', 'document')) {
                $table->string('document')->nullable();
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
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('document');
            
        });
Schema::table('documents', function (Blueprint $table) {
                        $table->text('document');
                
        });

    }
}
