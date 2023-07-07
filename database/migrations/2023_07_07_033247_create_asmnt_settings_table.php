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
        Schema::create('asmnt_settings', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name')->comment('Assessment Setting Name');
            $table->enum('type', ['manual', 'auto'])->comment('Assessment Setting Type');
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
        Schema::dropIfExists('asmnt_settings');
    }
};
