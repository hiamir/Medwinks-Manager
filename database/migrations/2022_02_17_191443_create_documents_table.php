<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applications_id')->unsigned();
            $table->foreign('applications_id','documents_fk0')->on('applications')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('service_requirements_id')->unsigned();
            $table->foreign('service_requirements_id','documents_fk1')->on('service_requirements')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('file');
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
        Schema::create('documents', function (Blueprint $table) {
            $table->dropForeign('documents_fk0');
            $table->dropForeign('documents_fk1');

        });
        Schema::dropIfExists('documents');
    }
}

