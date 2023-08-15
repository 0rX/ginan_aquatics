<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $item = Transaction::where('customer_id', Auth::user()->id)->where('status', 'in_cart')->with('details')->first();
        return view('pages.home.orders.cart', [
            'title' => 'Keranjang Anda',
            'item' => $item,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $cart = Transaction::where('customer_id', Auth::user()->id)->where('status', 'in_cart')->first();

        if ($cart == null) {
            $update_total_amount = $request->price * $request->quantity;
            Transaction::create([
                'customer_id' => Auth::user()->id,
                'total_amount' => $update_total_amount,
                'status' => 'in_cart'
            ]);

            $last_transaction = Transaction::where('customer_id', Auth::user()->id)->orderBy('id', 'DESC')->first();

            TransactionDetail::create([
                'transaction_id' => $last_transaction->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $request->price
            ]);
        } else {
            $transaction_detail_product = TransactionDetail::where('transaction_id', $cart->id)->where('product_id', $request->product_id)->first();

            if ($transaction_detail_product != null) {
                $update_quantity = $transaction_detail_product->quantity + $request->quantity;

                if ($update_quantity > $transaction_detail_product->product->stock) {
                    $update_quantity = $transaction_detail_product->product->stock;
                }

                TransactionDetail::where('product_id', $request->product_id)->update([
                    'quantity' => $update_quantity
                ]);
            } else {
                TransactionDetail::create([
                    'transaction_id' => $cart->id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                    'price' => $request->price
                ]);
            }

            $total_amount = 0;

            foreach ($cart->details as $item) {
                $total_amount += $item->quantity * $item->price;
            }

            $cart->update([
                'total_amount' => $total_amount,
            ]);
        }

        return redirect()->route('home.keranjang.index');
    }

    public function update(Request $request, $id)
    {
        $transaction_detail_product = TransactionDetail::findOrFail($id);
        $transaction_detail_product->update([
            'quantity' => $request->quantity
        ]);

        // MENGHITUNG KEMBALI TOTAL BELANJA
        $transaction = Transaction::findOrFail($transaction_detail_product->transaction_id);
        $total_amount = 0;

        foreach ($transaction->details as $item) {
            $total_amount += $item->quantity * $item->price;
        }

        $transaction->update([
            'total_amount' => $total_amount,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $detail = TransactionDetail::findOrFail($id);
        $transaction = Transaction::findOrFail($detail->transaction_id);
        $transaction->update([
            'total_amount' => $transaction->total_amount - ($detail->price * $detail->quantity),
        ]);

        $detail->delete();
        if ($transaction->total_amount == 0) {
            $transaction->delete();
        }

        return redirect()->back();
    }
}
