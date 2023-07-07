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
        Schema::create('asmnt_groups', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('certificate_setting_id')->constrained('asmnt_certificate_settings')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('name')->comment('Group Name');
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
        Schema::dropIfExists('asmnt_groups');
    }
};
