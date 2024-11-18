<!-- resources/views/checkout_success.blade.php -->
@extends('layouts.app')
@section('content')
<head>
<link rel="stylesheet" href="{{asset ('css/checkoutsuccess.css')}}">
</head>

<body>
    <div class="kontener">
        <h1>Pesanan Berhasil!</h1>
        <p>Terima kasih! Pesanan Anda telah berhasil dibuat.</p>
        <a href="{{ route('pesanan.index') }}" class="btn btn-primary">lihat pesanan saya</a>
        <a href="{{ url('belanja') }}" class="btn btn-primary">Kembali ke belanja</a>

    </div>
</body>
</html>
@endsection