<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Rating, review count and price shown in each product's Product schema
 * (aggregateRating and offers). All three are optional.
 */
return new class extends Migration {
    public function up()
    {
        Schema::table('admin_products', function (Blueprint $table) {
            if (!Schema::hasColumn('admin_products', 'rating_value')) {
                $table->decimal('rating_value', 2, 1)->nullable()->after('schema');
            }
            if (!Schema::hasColumn('admin_products', 'review_count')) {
                $table->unsignedInteger('review_count')->nullable()->after('rating_value');
            }
            if (!Schema::hasColumn('admin_products', 'price')) {
                $table->decimal('price', 10, 2)->nullable()->after('review_count');
            }
        });
    }

    public function down()
    {
        Schema::table('admin_products', function (Blueprint $table) {
            foreach (['rating_value', 'review_count', 'price'] as $column) {
                if (Schema::hasColumn('admin_products', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
