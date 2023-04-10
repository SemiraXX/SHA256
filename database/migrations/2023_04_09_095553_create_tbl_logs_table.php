<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('username');
            $table->integer('issuccess');
            $table->integer('isfailed');
            $table->string('remarks');
            $table->text('ip_add');
            $table->text('http_browser');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_logs');
    }
};
