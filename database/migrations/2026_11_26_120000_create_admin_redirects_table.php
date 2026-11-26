<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('admin_redirects')) {
            Schema::create('admin_redirects', function (Blueprint $table) {
                $table->id();
                $table->string('source_url', 500)->index();
                $table->string('target_url', 500)->nullable();
                $table->unsignedSmallInteger('status_code')->default(301);
                $table->string('match_type', 20)->default('exact');
                $table->boolean('is_active')->default(true);
                $table->boolean('preserve_query')->default(true);
                $table->unsignedBigInteger('hits')->default(0);
                $table->timestamp('last_hit_at')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('admin_redirects');
    }
};
