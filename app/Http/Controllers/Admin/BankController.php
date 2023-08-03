<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $items = Bank::all();
        return view('pages.admin.banks.index', [
            'title' => 'Manajemen Akun Bank',
            'items' => $items
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Bank::create($data);
        return redirect()->back();
    }

    public function update(Request $request, string $id)
    {
        $data = $request->all();
        Bank::findOrFail($id)->update($data);
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        Bank::findOrFail($id)->delete();
        return redirect()->back();
    }
}
