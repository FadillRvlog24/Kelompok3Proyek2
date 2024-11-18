@extends('layouts.app')

@section('content')
<a href="{{ url('cart') }}" class="back-btn">
    <img src="{{ asset('images/icons8back26.png') }}" alt="Back" class="back-icon">
</a>

<main class="checkout-container">
    <h1 class="checkout-title">Checkout</h1>

    <form action="{{ route('checkout.store') }}" method="POST" class="checkout-form" enctype="multipart/form-data">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="name" class="form-label">Nama</label>
            <input name="name" class="form-input" type="text" required/>
        </div>

        <div class="form-group">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" class="form-input" required></textarea>
        </div>

        <div class="form-group">
            <label for="no_telepon" class="form-label">No Telepon</label>
            <input name="no_telepon" class="form-input" type="text" required/>
        </div>

        <div class="form-group">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea name="catatan" class="form-input" placeholder="Tulis catatan jika ada..."></textarea>
        </div>

        <div class="form-group">
            <label for="metode_pembayaran" class="form-label">Pilih Metode Pembayaran:</label>
            <select name="metode_pembayaran" id="metode_pembayaran" class="form-input" required>
                <option value="">Pilih Metode Pembayaran</option>
                <option value="COD">COD</option>
                <option value="bank transfer">Transfer Bank</option>
                <option value="e-wallet">E-Wallet</option>
            </select>
        </div>

        <div class="buktiPembayaranField" id="buktiPembayaranField" style="display:none;">
            <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
            <input name="bukti_pembayaran" class="form-input" type="file" accept="image/*"/>
        </div>

        <div class="form-group">
        <label>
        <input type="radio" name="ongkir" value="10000" onchange="updateTotal()"> Area Jatibarang (Rp. 10.000)
    </label>
    <label>
        <input type="radio" name="ongkir" value="20000" onchange="updateTotal()"> Area Luar Jatibarang (Rp. 20.000)
    </label>
        </div>

        <table class="checkout-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cartItems = DB::table('cart')->get(); // Ambil data langsung di sini
                    $total_pembayaran = 0; // Variabel untuk menyimpan total harga
                @endphp
                @if($cartItems->isEmpty())
                    <tr>
                        <td colspan="3">Keranjang Anda kosong.</td>
                    </tr>
                @else
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                        </tr>
                        @php
                            // Hitung total harga
                            $total_pembayaran += $item->price * $item->quantity;
                        @endphp
                    @endforeach
                @endif
            </tbody>
        </table>

        <!-- Ongkir berdasarkan pilihan radio -->
        <div class="ongkir-container">
            @php
                $ongkir = 0; // Inisialisasi ongkos kirim
            @endphp
    <p>Ongkos Kirim: Rp. <span id="ongkirValue">{{ number_format(0, 0, ',', '.') }}</span></p>
    <p>Total Pembayaran: Rp. <span id="totalValue">{{ number_format($total_pembayaran, 0, ',', '.') }}</span></p>
        </div>

        <div class="checkout-btn-container">
            <button type="submit" class="checkout-btn">Checkout</button>
        </div>
    </form>
</main>

<!-- JavaScript untuk menampilkan field bukti pembayaran -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('metode_pembayaran').addEventListener('change', function() {
            var buktiPembayaranField = document.getElementById('buktiPembayaranField');
            
            // Tampilkan atau sembunyikan field upload bukti pembayaran
            buktiPembayaranField.style.display = (this.value === 'bank transfer' || this.value === 'e-wallet') ? 'block' : 'none';
        });

        // Fungsi untuk memperbarui total pembayaran dengan ongkir
        window.updateTotal = function() {
            var total_pembayaran = {{ $total_pembayaran }}; // Ambil total pembayaran dari keranjang
            var ongkir = 0;

            // Cek radio button yang dipilih
            var selectedArea = document.querySelector('input[name="ongkir"]:checked');
            if (selectedArea) {
                ongkir = parseInt(selectedArea.value); // Ambil ongkir dari value radio button
            }

            // Update nilai ongkir dan total pembayaran
            document.getElementById('ongkirValue').innerText = new Intl.NumberFormat('id-ID').format(ongkir);
            document.getElementById('totalValue').innerText = new Intl.NumberFormat('id-ID').format(total_pembayaran + ongkir);
        };

        // Jalankan updateTotal saat halaman dimuat jika radio button sudah dipilih
        updateTotal();
    });
</script>

@endsection
