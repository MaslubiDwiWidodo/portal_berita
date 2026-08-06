<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('articles') && !Schema::hasColumn('articles', 'image')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->string('image')->nullable()->after('status');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('articles') && Schema::hasColumn('articles', 'image')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }
};
