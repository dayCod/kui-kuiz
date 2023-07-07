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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('asmt_group_id')->constrained('asmnt_groups')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('asmnt_setting_id')->constrained('asmnt_settings')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('asmnt_name')->comment('Assessment Name');
            $table->timestamp('time_open')->nullable();
            $table->timestamp('time_close')->nullable();
            $table->integer('asmnt_time_test')->unsigned();
            $table->integer('total_is_correct')->nullable()->unsigned();
            $table->integer('total_score')->nullable()->unsigned();
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
        Schema::dropIfExists('assessments');
    }
};
