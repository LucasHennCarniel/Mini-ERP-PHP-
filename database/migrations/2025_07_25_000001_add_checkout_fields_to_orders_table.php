<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Adicione apenas os campos que NÃO existem ainda
            if (!Schema::hasColumn('orders', 'nome')) $table->string('nome')->nullable();
            if (!Schema::hasColumn('orders', 'email')) $table->string('email')->nullable();
            if (!Schema::hasColumn('orders', 'endereco')) $table->string('endereco')->nullable();
            if (!Schema::hasColumn('orders', 'numero')) $table->string('numero')->nullable();
            if (!Schema::hasColumn('orders', 'bairro')) $table->string('bairro')->nullable();
            if (!Schema::hasColumn('orders', 'cidade')) $table->string('cidade')->nullable();
            if (!Schema::hasColumn('orders', 'uf')) $table->string('uf')->nullable();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['nome', 'email', 'cep', 'endereco', 'numero', 'bairro', 'cidade', 'uf']);
        });
    }
};
