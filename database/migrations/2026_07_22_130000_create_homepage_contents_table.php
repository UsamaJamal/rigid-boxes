<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('homepage_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section', 64);
            $table->string('field_key', 128);
            $table->longText('value')->nullable();
            $table->string('value_type', 20)->default('text');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['section', 'field_key']);
            $table->index('section');
        });
    }

    public function down()
    {
        Schema::dropIfExists('homepage_contents');
    }
};
