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
        Schema::create('log_user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('log_user_id')->constrained('log_users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
                ->comment('Log User ID');
            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
                ->comment('User ID');
            $table->string('access_feature')->comment('Fitur Akses');
            $table->timestamp('access_time')->comment('Waktu Akses');
            $table->index(['id','user_id']);
            $table->index(['log_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_user_details');
    }
};
