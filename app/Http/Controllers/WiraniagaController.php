<?php

namespace App\Http\Controllers;

use App\Models\Wiraniaga;
use Illuminate\Http\Request;

class WiraniagaController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'status' => 'required|string|max:50',
            'target' => 'required|numeric|min:0',
            'jumlah_penjualan' => 'required|numeric|min:0',
            'mobil_terjual' => 'nullable|array', // contoh: ['agya', 'avanza']
        ]);

        Wiraniaga::create($data);

        return back()->with('success', 'Data wiraniaga berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $wiraniaga = Wiraniaga::find($id);

        if (!$wiraniaga) {
            return redirect()->back()->with('error', 'Data wiraniaga tidak ditemukan.');
        }

        $wiraniaga->delete();

        return redirect()->back()->with('success', 'Data wiraniaga berhasil dihapus.');
    }

    public function show($id)
    {
        $data = Wiraniaga::find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Data wiraniaga tidak ditemukan.');
        }

        //Gaji Pokok & Tunjangan
        // =====================
        $gajiPokok = 0;
        $tunjanganTransport = $data->jumlah_penjualan == 0 ? 750000 : 0;

        $tunjanganMap = [
            'JSE'  => ['target' => 3, 'transport' => 50000],
            'SE'   => ['target' => 5, 'transport' => 150000],
            'SSE'  => ['target' => 7, 'transport' => 700000],
            'PSSE' => ['target' => 10, 'transport' => 2050000],
        ];

        if ($data->jumlah_penjualan > 0 && isset($tunjanganMap[$data->jabatan])) {
            $jab = $tunjanganMap[$data->jabatan];
            if ($data->target == $jab['target']) {
                $gajiPokok = 3000000;
                $tunjanganTransport = $jab['transport'];
            }
        }

        // Insentif Progresif
        $insentifProgresif = $data->jumlah_penjualan >= $data->target
            ? 500000 * $data->jumlah_penjualan
            : 0;

        // Insentif per Unit Mobil
        $mobilTerjual = [
            'agya'   => 2,
            'avanza' => 1,
            'calya'  => 1,
            'camry'  => 0,
        ];

        $hargaUnit = [
            'JSE'  => ['agya' => 100000, 'avanza' => 150000, 'calya' => 100000, 'camry' => 450000],
            'SE'   => ['agya' => 200000, 'avanza' => 275000, 'calya' => 200000, 'camry' => 900000],
            'SSE'  => ['agya' => 275000, 'avanza' => 300000, 'calya' => 275000, 'camry' => 1000000],
            'PSSE' => ['agya' => 300000, 'avanza' => 400000, 'calya' => 300000, 'camry' => 1250000],
        ];

        $insentifUnit = 0;
        if (isset($hargaUnit[$data->jabatan])) {
            $insentifUnit = collect($mobilTerjual)->reduce(function ($total, $jumlah, $mobil) use ($hargaUnit, $data) {
                return $total + ($hargaUnit[$data->jabatan][$mobil] * $jumlah);
            }, 0);
        }

        // Bonus Dua Bulanan
        $bonusDuaBulanan = $data->jumlah_penjualan >= 5 ? 1500000 : 0;

        // Total Pendapatan
        $totalPendapatan = $gajiPokok + $tunjanganTransport + $insentifProgresif + $insentifUnit + $bonusDuaBulanan;

        return view('landing.show', compact(
            'data',
            'gajiPokok',
            'tunjanganTransport',
            'insentifProgresif',
            'insentifUnit',
            'bonusDuaBulanan',
            'totalPendapatan'
        ));
    }
}
