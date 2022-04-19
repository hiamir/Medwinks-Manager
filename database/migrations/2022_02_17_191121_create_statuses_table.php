<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('models_id')->nullable();
            $table->foreign('models_id','statuses_fk0')->on('models')->references('id')->onUpdate('cascade')->onDelete('restrict');
            $table->string('name');
            $table->string('reference');
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
        Schema::create('statuses', function (Blueprint $table) {
            $table->dropForeign('models_id');
        });
        Schema::dropIfExists('statuses');
    }
}

