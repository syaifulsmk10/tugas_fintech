<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
        public function topupnow(Request $request) 
    {
        $saldo = ModelsRequest::create([
            'user_id' => Auth::user()->id,
            'name' => 'topup',
            'total' => $request->jumlah,
        ]);
        // dd($saldo);
        return redirect()->back();
    }
    public function acctopup() {
        $reqTopup = ModelsRequest::where('user_id', 4)->where('name', 'topup')->get();

        return view('home', compact('reqTopup'));

    }
}
