<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Ui\Presets\React;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->limit(8)->get();
        return view('pages.home.homepage', [
            'title' => 'Homepage',
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function products()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->limit(8)->get();
        return view('pages.home.products.index', [
            'title' => 'Semua Produk',
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function product_detail($slug)
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $item = Product::where('slug', $slug)->first();
        $banks = Bank::all();

        return view('pages.home.products.detail', [
            'title' => $item->name,
            'item' => $item,
            'categories' => $categories,
            'banks' => $banks,
        ]);
    }

    public function categories()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('pages.home.categories.index', [
            'title' => 'Kategori Produk',
            'categories' => $categories,
        ]);
    }

    public function category_show($slug)
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $category = Category::where('slug', $slug)->first();

        return view('pages.home.categories.show', [
            'title' => 'Kategori Produk',
            'categories' => $categories,
            'category' => $category
        ]);
    }

    public function my_orders()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $items = Transaction::where('customer_id', Auth::user()->id)->where('status', '!=', 'in_cart')->get();
        return view('pages.home.orders.my-orders', [
            'title' => 'Pesanan saya',
            'items' => $items,
            'categories' => $categories,
        ]);
    }

    public function my_orders_update_status(Request $request, $id)
    {
        Transaction::findOrFail($id)->update($request->all());
        return redirect()->back();
    }

    public function change_profile(Request $request)
    {
        $data = $request->all();
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        User::findOrFail(Auth::user()->id)->update($data);
        return redirect()->back();
    }
}
