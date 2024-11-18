<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Tambahkan ini


class CartController extends Controller
{
    // Method untuk menambah produk ke keranjang
    public function addToCart(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'price' => 'required|integer', // Ubah dari string ke integer
            'quantity' => 'required|integer|min:1',
        ]);

        // Menambahkan produk ke tabel keranjang
        DB::table('cart')->insert([
            'product_name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'quantity' => $validatedData['quantity'],
        ]);

        // Redirect ke halaman keranjang
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Method untuk menampilkan isi keranjang
    public function index()
    {
        $cartItems = DB::table('cart')->get(); // Ambil semua data dari tabel cart
        return view('layouts.cart', compact('cartItems')); // Ganti 'layouts.cart' dengan path view yang sesuai
        
    }
    

    // Method untuk menghapus item dari keranjang
    public function removeFromCart(Request $request)
    {
        // Validasi input
        $request->validate([
            'id' => 'required|integer',
        ]);

        // Menghapus item dari tabel cart
        DB::table('cart')->where('id', $request->input('id'))->delete();

        // Redirect kembali ke halaman keranjang dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

     // Method untuk checkout
     public function checkout()
     {
         // Ambil semua item dari tabel keranjang untuk checkout
         $cartItems = DB::table('cart')->get();

         dd($cartItems); // Tambahkan ini untuk melihat apa yang ada dalam $cartItems

         // Mengirimkan data ke view checkout
         return view('layouts.checkout', compact('cartItems'));
     }
 
     // Method untuk memproses checkout
     public function store(Request $request)
     {
         // Validasi input checkout
         $validatedData = $request->validate([
             'name' => 'required|string|max:255',
             'alamat' => 'required|string|max:255',
             'no_telepon' => 'required|string|max:20',
             'metode_pembayaran' => 'required|string',
         ]);


    // Ambil semua item dari keranjang
    $cartItems = DB::table('cart')->get();
    $totalPembayaran = 0;

         if ($cartItems->isNotEmpty()) {
            // Hitung total harga
            foreach ($cartItems as $item) {
                $totalPembayaran += $item->price * $item->quantity;
            }
        } else {
            // Jika keranjang kosong, bisa mengarahkan kembali atau memberikan pesan
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong. Tambahkan produk sebelum checkout.');
        }
         
 
         // Lakukan pemrosesan sesuai kebutuhan (misalnya menyimpan pesanan)

        DB::table('transaksi')->insert([
            'name' => $validatedData['name'],
            'tanggal_order' => now(),
            'no_telepon' => $validatedData['no_telepon'],
            'alamat' => $validatedData['alamat'],
            'total_pembayaran' => $totalPembayaran,
            'metode_pembayaran' => $validatedData['metode_pembayaran'],
            'status' => 'pending', // Status default
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Hapus isi keranjang setelah checkout
        DB::table('cart')->truncate();
 
         // Redirect ke halaman beranda dengan pesan sukses
         return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat!');
     }

     
     public function increaseQuantity(Request $request)
{
    // Validasi input
    $request->validate([
        'id' => 'required|integer',
    ]);

    // Cari item di keranjang berdasarkan ID
    $cartItem = DB::table('cart')->where('id', $request->id)->first();

    if ($cartItem) {
        // Tambahkan kuantitas produk
        DB::table('cart')->where('id', $request->id)->update([
            'quantity' => $cartItem->quantity + 1,
        ]);
        return redirect()->route('cart.index')->with('success', 'Kuantitas produk berhasil ditambah.');
    }

    return redirect()->route('cart.index')->with('error', 'Item tidak ditemukan.');
}

public function decreaseQuantity(Request $request)
{
    // Validasi input
    $request->validate([
        'id' => 'required|integer',
    ]);

    // Cari item di keranjang berdasarkan ID
    $cartItem = DB::table('cart')->where('id', $request->id)->first();

    if ($cartItem && $cartItem->quantity > 1) {
        // Kurangi kuantitas produk
        DB::table('cart')->where('id', $request->id)->update([
            'quantity' => $cartItem->quantity - 1,
        ]);
        return redirect()->route('cart.index')->with('success', 'Kuantitas produk berhasil dikurangi.');
    } elseif ($cartItem && $cartItem->quantity <= 1) {
        return redirect()->route('cart.index')->with('error', 'Kuantitas produk minimal adalah 1.');
    }

    return redirect()->route('cart.index')->with('error', 'Item tidak ditemukan.');
}


}
