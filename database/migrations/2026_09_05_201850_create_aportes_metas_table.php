<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aportes_metas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meta_id')->constrained('metas')->onDelete('cascade');
            $table->foreignId('transacao_id')->nullable()->constrained('transacoes')->onDelete('set null');
            $table->decimal('valor', 12, 2);
            $table->date('data');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aportes_metas');
    }
};