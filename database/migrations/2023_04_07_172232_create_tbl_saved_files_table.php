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
        Schema::create('tbl_saved_files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('FileID');
            $table->text('FileName');
            $table->string('FileCateg');
            $table->text('HashValue');
            $table->string('PrivateKey');
            $table->string('PublicKey');
            $table->string('Signature');
            $table->string('PostedBy');
            $table->string('PostedDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_saved_files');
    }
};
