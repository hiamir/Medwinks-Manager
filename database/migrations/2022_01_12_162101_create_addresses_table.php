<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('address_type_id')->unsigned();
            $table->string('address_line1', 45);
            $table->string('address_line2', 45);
            $table->string('postal_code', 45);
            $table->string('zip_code', 45);
            $table->unsignedBigInteger('countries_id')->unsigned();
            $table->unsignedBigInteger('regions_id')->unsigned();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->softDeletes();


            //FOREIGN KEYS
            $table->foreign('address_type_id', 'addresses_fk0')->references('id')->on('address_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('countries_id', 'addresses_fk1')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('regions_id', 'addresses_fk2')->references('id')->on('regions')->onUpdate('cascade')->onDelete('cascade');

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
            $table->dropForeign('addresses_fk0');
            $table->dropForeign('addresses_fk1');
            $table->dropForeign('addresses_fk2');
            $table->dropForeign('addresses_fk3');
            $table->dropForeign('addresses_fk4');
        });
        Schema::dropIfExists('addresses');
    }

}
