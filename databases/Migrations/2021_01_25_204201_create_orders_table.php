<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->smallInteger('order')->default(1);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('address_id')->constrained('addresses');
            $table->foreignId('parent_id')->nullable()->constrained('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('plans');
            $table->foreignId('status_id')->constrained('order_statuses');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('code');
            $table->decimal('price', 8, 2);
            $table->boolean('recurrent')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('order_photo', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('photo_id')->constrained('photos');
        });

        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->string('type');
            $table->boolean('paid')->default(false);
            $table->string('return_code')->nullable();
            $table->string('return_message')->nullable();
            $table->json('return')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_payments');
        Schema::dropIfExists('order_photo');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_status');
    }
}
