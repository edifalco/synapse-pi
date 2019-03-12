<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552304239AcronymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acronyms', function (Blueprint $table) {
            if(Schema::hasColumn('acronyms', 'acronym')) {
                $table->dropColumn('acronym');
            }
            
        });
Schema::table('acronyms', function (Blueprint $table) {
            
if (!Schema::hasColumn('acronyms', 'acronym')) {
                $table->string('acronym')->nullable();
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
        Schema::table('acronyms', function (Blueprint $table) {
            $table->dropColumn('acronym');
            
        });
Schema::table('acronyms', function (Blueprint $table) {
                        $table->text('acronym');
                
        });

    }
}
