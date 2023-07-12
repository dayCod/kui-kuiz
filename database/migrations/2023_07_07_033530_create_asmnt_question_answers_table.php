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
        Schema::create('asmnt_question_answers', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('asmnt_question_id')->constrained('asmnt_questions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('alphabet');
            $table->text('answer');
            $table->boolean('is_correct')->nullable();
            $table->boolean('score')->nullable();
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
        Schema::dropIfExists('asmnt_question_answers');
    }
};
