<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuLinksRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_links_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_links_id')->unsigned();
            $table->unsignedBigInteger('role_id')->unsigned();
            $table->timestamps();

            //FOREIGN KEYS
            $table->foreign('menu_links_id','links_role_fk0')->references('id')->on('menu_links')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id','links_role_fk1')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_links_role', function (Blueprint $table) {
            $table->dropForeign('links_role_fk0');
            $table->dropForeign('links_role_fk1');
        });
        Schema::dropIfExists('links_role');
    }
}
