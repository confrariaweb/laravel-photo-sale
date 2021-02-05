<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('socialite_id');
            $table->unsignedBigInteger('user_id');
            $table->text('url');
            $table->string('name');
            $table->string('id_photo');
            $table->boolean('preferred')->default(false);
            $table->timestamps();
            $table->foreign('socialite_id')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->on('socialites');
            $table->foreign('user_id')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
