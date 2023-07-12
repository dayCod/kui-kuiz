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
        Schema::create('assessment_tests', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('assessment_id')->constrained('assessments')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('total_is_correct')->unsigned()->nullable();
            $table->integer('total_score')->unsigned()->nullable();
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
        Schema::dropIfExists('assessment_tests');
    }
};
