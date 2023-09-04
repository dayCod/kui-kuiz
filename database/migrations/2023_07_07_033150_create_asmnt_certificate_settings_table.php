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
            $table->string('heading');
            $table->text('description');
            $table->string('signatured_by');
            $table->text('certi_background_img')->nullable()->comment('File');
            $table->text('signature_img')->nullable()->comment('File');
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
        Schema::dropIfExists('asmnt_certificate_settings');
    }
};
