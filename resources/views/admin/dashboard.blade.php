@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h3 class="text-gray-700 text-3xl font-medium">Dashboard</h3>

    {{-- Stat Cards --}}
    <div class="mt-4">
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
                <div class="p-3 mr-4 text-indigo-500 bg-indigo-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Barang</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalBarang }}</p>
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Stok Tersedia</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stokTersedia }}</p>
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Stok Menipis</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stokMenipis }}</p>
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
                <div class="p-3 mr-4 text-red-500 bg-red-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Stok Habis</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stokHabis }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mt-8">
        <div class="xl:col-span-2 bg-white p-6 rounded-lg shadow-md">
            <h4 class="text-gray-700 text-lg font-semibold mb-4">Grafik Barang Berdasarkan Kondisi</h4>
            <div>
                <canvas id="kondisiChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
             <h4 class="text-gray-700 text-lg font-semibold mb-4">% Barang Termahal</h4>
             <div class="space-y-4">
                 @forelse ($barangTermahal as $barang)
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">{{ Str::limit($barang->nama_barang, 25) }}</p>
                            <p class="text-sm text-gray-500">Rp {{ number_format($barang->harga, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{-- route('admin.barang.show', $barang->id) --}}" class="px-3 py-1 bg-sky-500 text-white text-xs font-semibold rounded-full hover:bg-sky-600">Detail</a>
                    </div>
                 @empty
                    <p class="text-sm text-gray-500">Tidak ada data barang.</p>
                 @endforelse
             </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('kondisiChart').getContext('2d');
    const kondisiChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Baik', 'Rusak Ringan', 'Rusak Berat'],
            datasets: [{
                label: 'Jumlah Barang',
                data: [{{ $stokTersedia }}, {{ $stokMenipis }}, {{ $stokHabis }}],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.5)', // Green
                    'rgba(255, 159, 64, 0.5)', // Orange
                    'rgba(255, 99, 132, 0.5)'  // Red
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endpush
