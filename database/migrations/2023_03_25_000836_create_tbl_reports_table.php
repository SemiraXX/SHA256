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
        Schema::create('tbl_reports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('FileUploaded');
            $table->text('FileSHA256value');
            $table->string('OriginalFileID');
            $table->string('Admin');
            $table->text('Ip_add');
            $table->text('Http_browser');
            $table->string('Result');
            $table->text('Remarks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_reports');
    }
};
