@extends('layouts.app') <!-- Ganti dengan layout Anda -->

@section('content')
<div class="container">
<a href="{{ url('/home') }}" class="back-btn">
            <img src="{{ asset('images/icons8back26.png') }}" alt="Back" class="back-icon">
        </a>
    <h1>Pesanan Saya</h1>

    @if($pesanans->isEmpty())
        <p>Tidak ada pesanan yang ditemukan.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Total Pembayaran</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                    <th>Waktu Pemesanan</th>
                    <th>Bukti Transfer</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanans as $pesanan)
                    <tr>
                        <td>{{ $pesanan->id }}</td>
                        <td>{{ $pesanan->nama }}</td>
                        <td>{{ $pesanan->alamat }}</td>
                        <td>{{ $pesanan->no_telepon }}</td>
                        <td>{{ $pesanan->total_pembayaran }}</td>
                        <td>{{ $pesanan->metode_pembayaran }}</td>
                        <td>{{ $pesanan->status }}</td>
                        <td>{{ $pesanan->waktu_pemesanan }}</td>
                        <td>
                            @if($pesanan->bukti_transfer)
                                <img src="{{ asset('uploads/'.$pesanan->bukti_transfer) }}" alt="Bukti Transfer" style="width: 100px; height: auto;">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $pesanan->catatan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
