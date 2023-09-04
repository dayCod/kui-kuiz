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
            $table->enum('asmnt_type', ['score', 'corrections'])->comment('Assessment Type');
            $table->enum('check_type', ['manual', 'auto'])->comment('Assessment Checking Type');
            $table->timestamps();
            $table->index(['id', 'uuid']);
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
