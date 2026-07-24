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
        Schema::create('admin_authors', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Matches the dynamic module system's expectation for 'title' instead of 'name'
            $table->string('slug')->nullable()->unique();
            $table->string('status')->default('published');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->timestamps();
        });

        Schema::table('admin_blogs', function (Blueprint $table) {
            $table->foreignId('author_id')->nullable()->constrained('admin_authors')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_blogs', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
        });

        Schema::dropIfExists('admin_authors');
    }
};
