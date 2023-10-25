<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\transaction;
use App\Models\Wallets;
Use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function addToCart(Request $request) 
    {
       $user_id = $request->user_id;
    $product_id = $request->product_id;
    $status = 'di keranjang'; 
    $price = $request->price;
    $quantity = $request->quantity;

        Transaction::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'status' => $status,
                'price' => $price,
                'quantity'=>$quantity,
        ]);
        return redirect()->back()->with('status', 'Berhasil Menambah ke keranjang');
    }


    public function payNow() {
    $status = 'dibayar';
    $total_debit = 0; // Inisialisasi variabel total_debit

    // Menghitung total_debit
    $carts = Transaction::where('user_id', Auth::user()->id)->where('status', 'di keranjang')->get();
    
    foreach ($carts as $cart) {
        $total_price = $cart->price * $cart->quantity;
        $total_debit += $total_price;
    }

    // Membuat catatan transaksi di Wallets
    Wallets::create([
        'user_id' => Auth::user()->id,
        'debit' => $total_debit,
        'description' => 'Pembelian produk'
    ]);

    // Mengubah status transaksi
    foreach ($carts as $cart) {
        Transaction::find($cart->id)->update([
            'status' => $status,
            'order_id' => 'INV_' . $cart->id // Anda perlu mengganti ini sesuai dengan apa yang Anda inginkan
        ]);
    }

    return redirect()->back()->with('status', 'Berhasil membayar transaksi');
}



}