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
        Schema::create('featured_cities', function (Blueprint $table) {
            $table->id();
            $table->string('city_name',)->nullable();
            $table->text('city_summary',)->nullable();
            $table->string('section_name',)->nullable();
            $table->string('city_image',512)->nullable();
            $table->string('city_country',)->nullable();
            $table->string('is_active',)->default('0')->comment('0 means active | 1 means inactive');
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
        Schema::dropIfExists('featured_cities');
    }
};
