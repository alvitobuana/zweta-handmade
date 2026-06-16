@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-serif mb-6">Kelola Pesanan</h1>
    <div class="card">
        <p>Daftar pesanan (contoh statis)</p>
        <table class="w-full mt-4 text-sm">
            <thead>
                <tr class="text-left text-xs text-muted"><th>Kode</th><th>Customer</th><th>Produk</th><th>Status</th></tr>
            </thead>
            <tbody>
                <tr><td>ZW-24001</td><td>Aulia</td><td>Tote Custom</td><td>Produksi</td></tr>
                <tr><td>ZW-24002</td><td>Rani</td><td>Sling</td><td>Pending</td></tr>
            </tbody>
        </table>
    </div>
@endsection
