<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilePathToAddressBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */                                            
    public function up()
    {
        Schema::table('address_books', function (Blueprint $table) {
            $table->string('file_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('address_books', function (Blueprint $table) {
            $table->dropColumn('file_path');
        });
    }
}
                                   