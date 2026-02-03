<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (Schema::hasColumn('ec_product_categories', 'product_detail_content')) {
            return;
        }

        Schema::table('ec_product_categories', function (Blueprint $table): void {
            $table->mediumText('product_detail_content')->nullable();
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('ec_product_categories', 'product_detail_content')) {
            return;
        }

        Schema::table('ec_product_categories', function (Blueprint $table): void {
            $table->dropColumn('product_detail_content');
        });
    }
};
