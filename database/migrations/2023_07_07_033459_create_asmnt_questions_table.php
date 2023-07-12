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
        Schema::create('asmnt_questions', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('asmnt_id')->constrained('assessments')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->text('question');
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
        Schema::dropIfExists('asmnt_questions');
    }
};
