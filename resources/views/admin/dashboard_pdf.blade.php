{{-- File: resources/views/admin/dashboard_pdf.blade.php (Versi Aman) --}}
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Dashboard</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background-color: #f2f2f2; }
        h1, h2 { text-align: center; }
    </style>
</head>
<body>
    <h1>Laporan Dashboard Inventaris</h1>
    <p>Tanggal Cetak: {{ $tanggal }}</p>

    <h2>Ringkasan</h2>
    <table>
        <tr>
            <td>Total Jenis Barang</td>
            <td>{{ $totalBarang }}</td>
        </tr>
        <tr>
            <td>Total Stok Keseluruhan</td>
            <td>{{ $totalStock }}</td>
        </tr>
        <tr>
            <td>Total Nilai Inventory</td>
            <td>Rp {{ number_format($totalNilaiInventory, 0, ',', '.') }}</td>
        </tr>
    </table>

    <h2>Barang Baru Ditambahkan</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangTerbaru as $barang)
                <tr>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->stok }} {{ $barang->satuan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
