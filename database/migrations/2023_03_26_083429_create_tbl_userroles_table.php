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
        Schema::create('tbl_userroles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('cat_id');
            $table->integer('ViewReport');
            $table->integer('DeleteReport');
            $table->integer('Checkfile');
            $table->integer('UploadFile');
            $table->integer('ViewActionTrail');
            $table->integer('ViewTeams');
            $table->integer('AddnewTeam');
            $table->integer('RemoveTeam');
            $table->integer('ViewCategories');
            $table->integer('Addnewcategory');
            $table->integer('Removecategory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_userroles');
    }
};
