<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->string('periode'); // contoh: Jan 2026 / 01-01-2026 s/d 31-01-2026
            $table->integer('total_reservasi');
            $table->decimal('total_pendapatan', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
