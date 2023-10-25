<?php

namespace Database\Seeders;

use App\Models\category as Category;
use App\Models\product;
use App\Models\student;
use App\Models\User;
use App\Models\Wallets;
use App\Models\transaction;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FirstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         User::create([
            "name" => "Admin",
            "username" => "admin",
            "password" => Hash::make('admin'),
            "role" => "admin" // Tambahkan peran sebagai "admin"
        ]);

        User::create([
            "name" => "Tenizen Bank",
            "username" => "bank",
            "password" => Hash::make('bank'),
            "role" => "bank" // Tambahkan peran sebagai "bank"
        ]);

        User::create([
            "name" => "Tenizen Mart",
            "username" => "kantin",
            "password" => Hash::make('kantin'),
            "role" => "kantin" // Tambahkan peran sebagai "kantin"
        ]);

        User::create([
            "name" => "syaiful",
            "username" => "syaiful",
            "password" => Hash::make('syaiful'),
            "role" => "siswa" // Tambahkan peran sebagai "siswa"
        ]);

        Student::create([
            // Ganti "student" menjadi "Student"
            "user_id" => 2,
            // Gunakan nomor ID yang benar
            "nis" => "11111",
            "classroom" => "XII RPL",
        ]);


         Category::create([
            "name" => "Makanan",
        ]);

        
        Category::create([
            "name" => "Minuman",
        ]);

        
        Category::create([
            "name" => "Snack",
        ]);

        Product::create([
            // Ganti "product" menjadi "Product"
            "name" => "Coki-Coki",
            "price" => 1000,
            "stock" => 45,
            "photo" => "sdknudfbjdfifgbei",
            "description" => "Coki-coki",
            "categories_id" => 1,
            "stands" => 2,
            // Ganti "stand" menjadi "stands"
        ]);

        Product::create([
            "name" => "Coca Cola",
            "price" => 5000,
            "stock" => 100,
            "photo" => "sdknudisncnisdicnfgbei",
            "description" => "Coca Cola",
            "categories_id" => 1,
            "stands" => 1,
        ]);

        Product::create([
            "name" => "Nasi Uduk",
            "price" => 2000,
            "stock" => 100,
            "photo" => "sdknukjidviesofgbei",
            "description" => "Nasi Uduk",
            "categories_id" => 1,
            "stands" => 2,
        ]);

          Transaction::create([
            "user_id" => 4,
            "product_id" => 1,
            "status" => "di keranjang",
            // Ubah "Dikeranjang" menjadi "di keranjang"
            "order_id" => "INV_11111",
            "price" => 1000,
            "quantity" => 1,
        ]);

        Transaction::create([
            "user_id" => 2,
            "product_id" => 2,
            "status" => "di keranjang",
            // Ubah "Dikeranjang" menjadi "di keranjang"
            "order_id" => "INV_22222",
            "price" => 4000,
            "quantity" => 1,
        ]);

        Transaction::create([
            "user_id" => 1,
            "product_id" => 3,
            "status" => "di keranjang",
            // Ubah "Dikeranjang" menjadi "di keranjang"
            "order_id" => "INV_22222",
            "price" => 1000,
            "quantity" => 1,
        ]);


        Wallets::create([
            // Ganti "wallets" menjadi "Wallet"
            "user_id" => 4,
            "debit" => 4000,
            // Ganti "price" menjadi "debit"
            "description" => "Top Up Saldo",
        ]);

        Wallets::create([
            "user_id" => 4,
            "debit" => 2000,
            // Ganti "price" menjadi "balance" dan ubah ke negatif
            "description" => "Biaya Pembukaan Tabungan",
        ]);

      
        $transactions = Transaction::where('order_id', 'INV_11111')->get();

        $total_debit = 0;

        foreach ($transactions as $transaction) {
            $total_price = $transaction->price * $transaction->quantity;
            $total_debit += $total_price;
        }

        Wallets::create([
            // Ganti "wallets" menjadi "Wallet"
            "user_id" => 4,
            "debit" => $total_debit,
            // Ganti "price" menjadi "debit"
            "description" => "Pembelian produk",
        ]);

        foreach ($transactions as $transaction) {
            $transaction->update([
                'status' => 'dibayar'
            ]);
        }

        foreach ($transactions as $transaction) {
            $transaction->update([
                'status' => 'diambil'
            ]);
        }
    }
}