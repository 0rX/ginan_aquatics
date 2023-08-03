<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $items = User::where('roles', 'admin')->get();
        return view('pages.admin.users.index', [
            'title' => 'User',
            'items' => $items
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['roles'] = 'admin';
        User::create($data);
        return redirect()->back();
    }

    public function update(Request $request, string $id)
    {
        $data = $request->all();
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        User::findOrFail($id)->update($data);
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back();
    }
}
