<?php

namespace App\Http\Controllers;

use DB;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Transaksi;
use App\DetilTransaksi;
use App\Presensi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::leftJoin('detil_transaksi',
                                        'transaksi.id_transaksi',
                                        '=',
                                        'detil_transaksi.id_transaksi')
                                ->leftJoin('inventori',
                                        'detil_transaksi.tipe_barang',
                                        '=',
                                        'inventori.tipe_brg')
                                ->leftJoin('master_merk',
                                        'inventori.id_merk',
                                        '=',
                                        'master_merk.id_merk')
                                ->leftJoin('master_kategori',
                                        'inventori.id_kategori',
                                        '=',
                                        'master_kategori.id_kategori')
                                ->select([
                                        'master_kategori.kategori',
                                        'master_merk.merk',
                                        'inventori.tipe_brg',
                                        DB::raw('SUM(detil_transaksi.jumlah) as jumlah')
                                    ])
                                ->where('transaksi.id_jenis_transaksi', 1)
                                ->orderBy('jumlah','desc')
                                ->groupBy('inventori.tipe_brg')
                                ->limit(10)
                                ->get();

        $transaksis2 = Transaksi::leftJoin('detil_transaksi',
                                        'transaksi.id_transaksi',
                                        '=',
                                        'detil_transaksi.id_transaksi')
                                ->leftJoin('inventori',
                                        'detil_transaksi.tipe_barang',
                                        '=',
                                        'inventori.tipe_brg')
                                ->leftJoin('master_merk',
                                        'inventori.id_merk',
                                        '=',
                                        'master_merk.id_merk')
                                ->leftJoin('master_kategori',
                                        'inventori.id_kategori',
                                        '=',
                                        'master_kategori.id_kategori')
                                ->select([
                                        'master_kategori.kategori',
                                        'master_merk.merk',
                                        'inventori.tipe_brg',
                                        DB::raw('SUM(detil_transaksi.jumlah) as jumlah')
                                    ])
                                ->where('transaksi.id_jenis_transaksi', 2)
                                ->orderBy('jumlah','desc')
                                ->groupBy('inventori.tipe_brg')
                                ->limit(10)
                                ->get();

        $today_date = date("Y-m-d");

        $penjualan = Transaksi::select([
                                        DB::raw('COUNT(transaksi.id_jenis_transaksi) as penjualan')
                                    ])
                                ->where('transaksi.id_jenis_transaksi', 1)
                                ->where('transaksi.tanggal_transaksi', $today_date)
                                ->pluck('penjualan');

        $keuntungan = DetilTransaksi::leftJoin('transaksi',
                                    'detil_transaksi.id_transaksi',
                                    '=',
                                    'transaksi.id_transaksi')
                                ->leftJoin('inventori',
                                    'detil_transaksi.tipe_barang',
                                    '=',
                                    'inventori.tipe_brg')
                                ->select([
                                            DB::raw('SUM((detil_transaksi.harga - detil_transaksi.harga_modal) * detil_transaksi.jumlah) as penjualan')
                                        ])
                                ->where('transaksi.tanggal_transaksi', $today_date)
                                ->where('transaksi.id_jenis_transaksi', 1)
                                ->pluck('penjualan');

        $presensi_tak_masuk = Presensi::select([
                                        DB::raw('(SELECT(COUNT(karyawan.nama_karyawan)) FROM karyawan) as tak_masuk'),
                                        DB::raw('COUNT(*) as masuk'),
                                    ])
                                ->where('presensi_karyawan.tgl_presensi', $today_date)
                                ->value('tak_masuk');

        $presensi_masuk = Presensi::select(DB::raw('COUNT(*) as masuk'))
                                ->where('presensi_karyawan.tgl_presensi', $today_date)
                                ->value('masuk');

        $presensi = $presensi_tak_masuk - $presensi_masuk;

        return view('modules.dashboard.dashboard')->with('transaksi', $transaksis)
                                                    ->with('transaksi2', $transaksis2)
                                                    ->with('penjualan', $penjualan)
                                                    ->with('keuntungan', $keuntungan)
                                                    ->with('presensi', $presensi);

    }
}
