<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Reservasi</title>
    <style>
        body { font-family: DejaVu Sans; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #000; padding: 8px; }
    </style>
</head>
<body>

<h2 align="center">LAPORAN RESERVASI STUDIO</h2>

<table>
    <tr>
        <th>Periode</th>
        <td>{{ $laporan->periode }}</td>
    </tr>
    <tr>
        <th>Total Reservasi</th>
        <td>{{ $laporan->total_reservasi }}</td>
    </tr>
    <tr>
        <th>Total Pendapatan</th>
        <td>Rp {{ number_format($laporan->total_pendapatan, 0, ',', '.') }}</td>
    </tr>
</table>

<br><br>
<p align="right">
    Dicetak pada {{ now()->format('d-m-Y') }}
</p>

</body>
</html>
