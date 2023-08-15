<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $items = Product::all();

        return view('pages.admin.products.index', [
            'title' => 'Semua Menu',
            'items' => $items
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.admin.products.create', [
            'title' => 'Tambah Menu Baru',
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['image'] = $request->file('image')->store('products', 'public');

        Product::create($data);
        return redirect()->route('produk.index');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $item = Product::findOrFail($id);

        return view('pages.admin.products.edit', [
            'title' => 'Edit Menu ' . $item->name,
            'item' => $item,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        if (!empty($data['image'])) {
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            unset($data['image']);
        }

        Product::findOrFail($id)->update($data);
        return redirect()->route('produk.index');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('produk.index');
    }
}
