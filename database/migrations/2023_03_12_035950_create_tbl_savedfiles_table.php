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
        Schema::create('tbl_savedfiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('fileID');
            $table->text('fileName');
            $table->text('fileUrl');
            $table->string('fileCateg');
            $table->text('SHA256Argon2');
            $table->string('postedBy');
            $table->string('postedDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_savedfiles');
    }
};
