<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $items = Transaction::where('status', '!=', 'in_cart')->orderBy('created_at', 'DESC')->get();

        return view('pages.admin.transactions.index', [
            'items' => $items,
            'title' => 'Transaksi'
        ]);
    }

    public function update(Request $request, $id)
    {
        Transaction::findOrFail($id)->update($request->all());
        return redirect()->back();
    }

    public function report()
    {
        $items = Transaction::where('status', 'success')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('pages.admin.transactions.report', [
            'items' => $items,
            'title' => 'Transaksi'
        ]);
    }

    public function report_filter(Request $request)
    {
        $items = Transaction::whereMonth('created_at', $request->bulan)
            ->whereYear('created_at', $request->tahun)
            ->where('status', 'success')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('pages.admin.transactions.report-filter', [
            'title' => 'Laporan Bulan ' . $request->bulan . ' Tahun ' . $request->tahun,
            'items' => $items,
            'month' => $request->bulan,
            'year' => $request->tahun
        ]);
    }

    public function print($bulan, $tahun)
    {
        if ($bulan == 'all' && $tahun == 'all') {
            $items = Transaction::where('status', 'success')
                ->orderBy('created_at', 'DESC')
                ->get();

            $title = 'Semua Laporan Penjualan';
        } else {
            $items = Transaction::whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun)
                ->where('status', 'success')
                ->orderBy('created_at', 'DESC')
                ->get();

            $title = 'Laporan Bulan ' . $bulan . ' Tahun ' . $tahun;
        }

        return view('pages.admin.transactions.print', [
            'title' => $title,
            'items' => $items
        ]);
    }
}
