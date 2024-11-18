<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Gunakan DB facade untuk operasi database
use Illuminate\Support\Facades\Log; 

class CheckoutController extends Controller
{
    public function index()
    {
        
    // Ambil transaksi pengguna yang terotentikasi
    $transaksis = Auth::check() ? DB::table('transaksi')->where('id', Auth::id())->get() : [];

     // Hitung total pembayaran dari keranjang
     $total_pembayaran = DB::table('cart')->sum(DB::raw('price * quantity'));

    // Menampilkan halaman form checkout dan data transaksi
    return view('checkout', compact('transaksis'));
    }

    public function store(Request $request)
{
    // Validasi data yang diinput pengguna
    $request->validate([
        'name' => 'required|string|max:100', // Sesuaikan panjang dengan kolom 'nama'
        'no_telepon' => 'required|string|max:20',
        'alamat' => 'required|string|max:255', // Panjang diubah agar sesuai dengan tabel
        'metode_pembayaran' => 'required|string|max:20', // Sesuaikan dengan panjang kolom di tabel
        'catatan' => 'nullable|string', // Validasi catatan
        'bukti_pembayaran' => 'nullable|image|max:2048', // Validasi upload bukti pembayaran
    ]);

     // Hitung total pembayaran dari keranjang
     $total_pembayaran = DB::table('cart')->sum(DB::raw('price * quantity')) + $request->ongkir;

    try {
        // Aktifkan logging query
        DB::enableQueryLog();
        
        // Persiapkan data untuk disimpan di tabel 'transaksi'
        $data = [
            'nama' => $request->name,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'total_pembayaran' => $total_pembayaran, // Perbaiki di sini
            'metode_pembayaran' => $request->metode_pembayaran,
            'catatan' => $request->catatan, // Menambahkan catatan
            'waktu_pemesanan' => now(), // Menggunakan waktu saat ini
            'status' => 'pending', // Status default
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Simpan bukti pembayaran jika ada
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['bukti_transfer'] = $filename; // Simpan nama file bukti transfer
        }

        // Masukkan data pesanan ke tabel 'transaksi'
        DB::table('transaksi')->insert($data);

        Log::info(DB::getQueryLog()); // Mencetak log query yang dijalankan

    } catch (\Exception $e) {
        Log::error('Gagal menyimpan pesanan: ' . $e->getMessage()); // Logging jika terjadi error
        return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan pesanan: ' . $e->getMessage()]);
    }

    // Hapus session keranjang setelah pesanan dibuat (opsional)
    session()->forget('cart');

    // Redirect ke halaman keranjang dengan pesan sukses
    return redirect()->route('checkout.success')->with('success', 'Pesanan berhasil dibuat!');

}



}
