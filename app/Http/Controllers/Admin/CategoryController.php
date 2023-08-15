<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $items = Category::all();
        return view('pages.admin.categories.index', [
            'title' => 'Kategori Produk',
            'items' => $items
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        Category::create($data);
        return redirect()->back();
    }

    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        Category::findOrFail($id)->update($data);
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->back();
    }
}
