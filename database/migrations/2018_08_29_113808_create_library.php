<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libraries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('fax')->unique();
            $table->string('email')->unique();
            $table->string('image');
            $table->string('address');
            $table->double('long');
            $table->double('lat');
            $table->enum('lang', ['en', 'ar']);
            $table->timestamps();
            $table->softDeletes();

//            /**
//             *
//             * define custom constraint name
//             *
//             */
//            $table->string('email');
//            $table->unique('email','email_library_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libraries');
    }
}
