<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use PDF;

class OrderController extends Controller
{
    private function getCarts()
    {
        $carts = json_decode(request()->cookie('tutik-cart'), true);
        $carts = $carts != '' ? $carts : [];
        return $carts;
    }

    public function index()
    {
        $products = Product::all();
        return view('order.order', compact('products'));
    }

    public function addTocart(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty'   => 'required|integer',
        ]);

        $carts = json_decode($request->cookie('tutik-cart'), true);

        if ($carts && array_key_exists($request->product_id, $carts)) {
            $carts[$request->product_id]['qty'] += $request->qty;
        } else {
            $product = Product::find($request->product_id);
            $carts[$request->product_id] = [
                'qty' => $request->qty,
                'product_id' => $product->id,
                'product_name' => $product->nama,
                'product_price' => $product->harga,
                'product_image' => $product->gambar
            ];
        }

        $cookie = cookie('tutik-cart', json_encode($carts), 2880);

        return redirect()->back()->cookie($cookie);
    }

    public function listCart()
    {
        $carts = json_decode(request()->cookie('tutik-cart'), true);
        $subtotal = collect($carts)->sum(function ($q) {
            return $q['qty'] * $q['product_price'];
        });
        return view('order.orderCheckout', compact('carts', 'subtotal'));
    }

    public function updateCart(Request $request)
    {
        $carts = json_decode(request()->cookie('tutik-cart'), true);
        foreach ($request->product_id as $key => $row) {
            if ($request->qty[$key] == 0) {
                unset($carts[$row]);
            } else {
                $carts[$row]['qty'] = $request->qty[$key];
            }
        }
        $cookie = cookie('tutik-cart', json_encode($carts), 2880);
        return redirect()->back()->cookie($cookie);
    }
    public function orderCheckout(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required',
            'phone'       => 'required',
        ]);

        $pesanan = Order::whereDate('created_at', Carbon::today())->where('status', '!=', 2)->get();
        if ($pesanan->count() >= 9) {
            return redirect()->back()->with(Session::flash('message', 'Orderan Penuh'));
        } else {
            DB::beginTransaction();
            try {
                $lates = Order::orderBy('created_at', 'DESC')->first();
                $antrian = 000;
                $antrian = Carbon::now()->format('Y-m-d') != Carbon::createFromFormat('Y-m-d H:i:s', $lates->created_at)->format('Y-m-d') ? 000 + 1 : $lates->nomor_antrian + 1;
                $estimasi = Carbon::now()->addMinutes(10);
                $carts = $this->getCarts();
                $total = collect($carts)->sum(function ($q) {
                    return $q['qty'] * $q['product_price'];
                });

                $customer = Customer::create([
                    'name' => $request->name,
                    'phone' => $request->phone
                ]);

                $order = Order::create([
                    'nomor_antrian' => $antrian,
                    'customer_id' => $customer->id,
                    'estimasi' => $estimasi,
                    'status' => 0,
                    'total' => $total
                ]);
                foreach ($carts as $row) {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $row['product_id'],
                        'nama_produk' => $row['product_name'],
                        'harga' => $row['product_price'],
                        'qty' => $row['qty'],
                        'subtotal' => $row['qty'] * $row['product_price']
                    ]);
                }

                DB::commit();
                $carts = [];
                $cookie = cookie('tutik-cart', json_encode($carts), 2880);
                return redirect(route('home'))->cookie($cookie)->with(Session::flash('success', $customer->id));
            } catch (\Throwable $e) {
                DB::rollback();
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
    }

    function downloadPdf($id)
    {
        $customer = Customer::where('id', $id)->first();
        $order = Order::where('customer_id', $id)->first();
        $product = OrderProduct::where('order_id', $order->id)->get();
        $view = View::make('order.invoice', compact('order', 'customer', 'product'));
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view->render());
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $output = $dompdf->stream();
        return $output;
    }
}
