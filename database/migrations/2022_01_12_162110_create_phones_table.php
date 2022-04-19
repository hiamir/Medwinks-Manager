<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->string('name',45);
            $table->unsignedBigInteger('addresses_id')->unsigned();
            $table->unsignedBigInteger('phones_type_id')->unsigned();
            $table->unsignedBigInteger('countries_id')->unsigned();
            $table->unsignedBigInteger('created_by')->unsigned();
            $table->unsignedBigInteger('updated_by')->unsigned();
            $table->string('phone_number',45);

            //FOREIGN KEYS
            $table->foreign('addresses_id','phones_fk0')->references('id')->on('addresses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('phones_type_id','phones_fk1')->references('id')->on('phone_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('countries_id','phones_fk2')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('created_by','phones_fk3')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('updated_by','phones_fk4')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phones', function (Blueprint $table) {
            $table->dropForeign('phones_fk0');
            $table->dropForeign('phones_fk1');
            $table->dropForeign('phones_fk2');
            $table->dropForeign('phones_fk3');
            $table->dropForeign('phones_fk4');
        });
        Schema::dropIfExists('phones');
    }

}
