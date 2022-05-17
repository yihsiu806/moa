<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('from')->nullable()->default(null);
            $table->date('to')->nullable()->default(null);
            $table->integer('download')->nullable()->default(0);
            $table->string('path');
            $table->bigInteger('owner')->unsigned();
            $table->foreign('owner')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('division')->unsigned();
            $table->foreign('division')->references('id')->on('divisions')->onDelete('cascade');
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
        Schema::dropIfExists('files');
    }
}
