<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_links', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('route');
            $table->string('route_index');
//            $table->string('roles');
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('folder_id');
            $table->string('position');
            $table->timestamps();

            //FOREIGN KEYS
            $table->foreign('permission_id','menu_links_fk0')->on('permissions')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('folder_id','menu_links_fk1')->on('menu_folders')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id','menu_links_fk2')->on('menu_categories')->references('id')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_links', function (Blueprint $table) {
            $table->dropForeign('menu_links_fk0');
            $table->dropForeign('menu_links_fk1');
            $table->dropForeign('menu_links_fk2');
        });
        Schema::dropIfExists('menu_links');
    }
}
