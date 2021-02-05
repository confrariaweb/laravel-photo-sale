<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->text('description')->nullable();
            $table->integer('photo_amount')->default(0);
            $table->text('photo_type')->nullable();
            $table->boolean('recurrent')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('plan_user', function (Blueprint $table) {
            $table->foreignId('plan_id')->constrained('plans');
            $table->foreignId('user_id')->constrained('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_user');
        Schema::dropIfExists('plans');
    }
}
