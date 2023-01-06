<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->integer('counter')->nullable();
            $table->integer('category');
            $table->string('contact_name')->nullable();
            $table->string('keywords')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('date')->nullable();
            $table->string('company_name');
            $table->string('email')->nullable();
            $table->string('job_title')->nullable();
            $table->string('business_phone')->nullable();
            $table->string('mobile_phone_1');
            $table->string('mobile_phone_2')->nullable();
            $table->longText('address');
            $table->string('city');
            $table->string('zip_code')->nullable();
            $table->string('country');
            $table->string('approval')->nullable();
            $table->string('active')->nullable();
            $table->integer('data_by_user')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
