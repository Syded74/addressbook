<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToAddressBookTable extends Migration
{
    public function up()
    {
        Schema::table('address_books', function (Blueprint $table) {
            $table->string('status')->default('inactive'); // Adding the status column with a default value
        });
    }

    public function down()
    {
        Schema::table('address_books', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
