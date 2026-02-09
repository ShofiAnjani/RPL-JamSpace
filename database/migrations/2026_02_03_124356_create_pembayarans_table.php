<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
       Schema::create('pembayarans', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_reservasi');
        $table->string('metode'); // cash, transfer, qris, ewallet$table->decimal('jumlah', 12, 2);
        $table->string('status_pembayaran'); // pending, dibayar
        // table->timestamps();
        
        $table->foreign('id_reservasi')
        ->references('id')
        ->on('reservasis')
        ->cascadeOnDelete();
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
