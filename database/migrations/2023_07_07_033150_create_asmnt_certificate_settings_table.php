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
        Schema::create('asmnt_certificate_settings', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->enum('page_orientation', ['potrait', 'landscape'])->nullable();
            $table->string('heading')->nullable();
            $table->string('frst_sub_heading')->nullable();
            $table->string('scnd_sub_heading')->nullable();
            $table->text('description')->nullable();
            $table->text('sub_description')->nullable();
            $table->string('signature_by')->nullable();
            $table->text('certi_background_img')->nullable()->comment('File');
            $table->text('signature_img')->nullable()->comment('File');
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
        Schema::dropIfExists('asmnt_certificate_settings');
    }
};
