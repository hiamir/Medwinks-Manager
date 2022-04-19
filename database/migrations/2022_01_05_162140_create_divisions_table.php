<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('companies_id')->unsigned();
            $table->string('name',45);
            $table->text('description');
            $table->string('website',45);
            $table->timestamps();

            //FOREIGN KEYS
            $table->foreign('companies_id','divisions_fk0')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
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
            $table->dropForeign('divisions_fk0');
        });
        Schema::dropIfExists('divisions');
    }
}
