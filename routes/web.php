<?php

use App\Http\Controllers\LaporanController;

Route::post('/laporan/generate', [LaporanController::class, 'generate'])
    ->name('laporan.generate');

Route::get('/laporan/cetak/{id}', [LaporanController::class, 'cetakPdf'])
    ->name('laporan.cetak');

Route::get('/laporan/generate-bulanan', [LaporanController::class, 'generateBulanan'])
    ->name('laporan.generate.bulanan');