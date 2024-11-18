<!-- resources/views/layouts/cart.blade.php -->
@extends('layouts.app')
@section('content')
<main class="font-roboto">
    <div class="relative">
    <img src="{{ asset('images/bolu_ultah.jpg') }}" alt="" class="hero-img">
    <div class="hero-text">
    <h1>Keranjang</h1>
    <section class="lokasi">
    <a href="{{ url('home') }}" class="lokasi-item">Beranda</a> <a href="{{ url('cart') }}" class="lokasi-item">Keranjang</a>
</section>
    </div>
    <div class="p-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="cart-items">
    @if($cartItems->isEmpty())
        <p>Keranjang Anda kosong.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                    <th>Aksi</th> 
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>
                                        <form action="{{ route('cart.increase') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-success">+</button>
                                        </form>
                                        {{ $item->quantity }}
                                        <form action="{{ route('cart.decrease') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-warning">-</button>
                                        </form>
                                    </td>
                        
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}"> <!-- ID item untuk dihapus -->
                                <button type="submit" class="btn btn-danger">Hapus</button> <!-- Tombol hapus -->
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- !-- Total Price Calculation --> 
                <div class="flex justify-between items-center border-t py-4 mt-4 total-container">
                    <span class="font-bold">Total Harga:</span>
                    <span class="font-bold total-price">
                        Rp {{ number_format($cartItems->sum(function($item) { return $item->price * $item->quantity; }), 0, ',', '.') }}
                    </span>
                </div>

                <!-- Checkout Button -->
                <div class="ml-auto"> <!-- This div will push the button to the right -->
        <a href="{{ route('checkout') }}" class="checkout-button">Checkout</a>
    </div>
    @endif
</div>
</div>
</main>
@endsection
