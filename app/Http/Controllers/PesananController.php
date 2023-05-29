<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Order::with('customer')->with('orderProduct')->whereDate('created_at', Carbon::today())->orderBy('nomor_antrian', 'DESC')->get();
        return view('pesanan.index', compact('pesanan'));
    }

    public function updatePesanan(Request $request, $id)
    {
        $pesanan = Order::find($id);
        if ($pesanan->status == 0) {
            $pesanan->update(['status' => 1]);
        } else {
            $pesanan->update(['status' => 2]);
        }

        return redirect()->back()->with(Session::flash('message', 'Status pesanan diperbarui!'));
    }
}
