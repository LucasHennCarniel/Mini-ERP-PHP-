<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->float('subtotal')->nullable()->change();
            $table->float('freight')->nullable()->change();
            $table->float('total')->nullable()->change();
            $table->string('cep')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->float('subtotal')->nullable(false)->change();
            $table->float('freight')->nullable(false)->change();
            $table->float('total')->nullable(false)->change();
            $table->string('cep')->nullable(false)->change();
        });
    }
};
