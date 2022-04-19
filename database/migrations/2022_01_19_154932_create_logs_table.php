<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('log_type_id')->unsigned();
            $table->unsignedBigInteger('auth_id')->unsigned();
            $table->unsignedBigInteger('guard_id')->unsigned();
            $table->string('message');
            $table->timestamps();


            //FOREIGN KEYS
            $table->foreign('log_type_id', 'logs_fk0')->references('id')->on('log_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('guard_id', 'logs_fk1')->references('id')->on('guard_types')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->dropForeign('logs_fk0');
            $table->dropForeign('logs_fk1');
        });
        Schema::dropIfExists('logs');
    }
}
