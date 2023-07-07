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
        Schema::create('asmnt_config_setting', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('app_name')->nullable();
            $table->string('app_version')->nullable();
            $table->string('app_database')->nullable();
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
        Schema::dropIfExists('asmnt_config_setting');
    }
};
