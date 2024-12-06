<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBancardSingleBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bancard_single_buys', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('currency', 3)->nullable();
            $table->string('additional_data', 100)->default('')->nullable(false);
            $table->string('description', 255)->nullable();
            $table->string('status', 20)->nullable();
            $table->string('process_id', 20)->nullable();
            $table->boolean('zimple')->default(false);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE bancard_single_buys ADD shop_process_id SERIAL NOT NULL UNIQUE;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bancard_single_buys');
    }
}
