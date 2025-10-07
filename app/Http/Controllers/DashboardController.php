<?php

namespace App\Http\Controllers;

use App\Models\Wiraniaga;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input pencarian nama
        $nama = $request->input('nama');

        // Ambil jumlah data per halaman, default 5
        $paginate = $request->input('itemsPerPage', 5);

        // Query ke tabel wiraniagas
        $query = Wiraniaga::query();

        // Jika ada pencarian berdasarkan nama
        if (!empty($nama)) {
            $query->where('nama', 'LIKE', '%' . $nama . '%')
                ->orWhere('jabatan', 'LIKE', '%' . $nama . '%');
        }

        // Ambil data dengan pagination
        $wiraniagas = $query->paginate($paginate)->withQueryString();

        // Kirim ke view landing.home
        return view('landing.home', compact('wiraniagas'));
    }
}
