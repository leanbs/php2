<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Illuminate\Http\Request;
use Datatables;
use App\Http\Requests;

use App\Transaksi;
use App\DetilTransaksi;
use App\Inventori;
use App\Merk;
use App\Presensi;
use App\Karyawan;
use App\Pengaturan;

class PagesController extends Controller
{
    public function getTipeMerkManage()
    {
        return view('modules.kategorinmerk.manage');
    }

    public function getDataMasterManage()
    {
        return view('modules.datamaster.manage');
    }

    /**
     * Display transaction details along with the groups (or single).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id  Requested transaction's id
     * @return \Illuminate\Http\Response
     */
    public function getTransaksi(Request $request, $id)
    {
        try {
            $transaksi = Transaksi::findOrFail($id);
            $detil = Transaksi::find($id)->detil_transaksi;
            $detil23 = Transaksi::find($id)->detil_transaksi;

            $harga_modal = DetilTransaksi::leftJoin('inventori',
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
                                            ->where('detil_transaksi.id_transaksi', $id)
                                            ->select([
                                                    'inventori.harga_barang',
                                                    'master_merk.merk',
                                                    'master_kategori.kategori',
                                                ])
                                            ->get();

            $data['detil'] = $detil;
            $data['harga_modal'] = $harga_modal;
            $data['detil2'] = $transaksi;
            $data['karyawan'] = $transaksi->karyawan->nama_karyawan;
            $data['id_transaksi'] = $transaksi->id_transaksi;
            $data['tanggal'] = $transaksi->tanggal_transaksi;
            $data['nama_pelanggan'] = $transaksi->nama_pelanggan;

        } catch (ModelNotFoundException $e) {
            return view('partials.modal.error', [
                'error' => trans('modal.fail.missing'),
            ]);
        } catch (\Exception $e) {
            Log::error($e);

            return view('partials.modal.error', [
                'error' => trans('modal.fail.unknown'),
            ]);
        }

        // TODO: Implement PdfJs to handle pdf file view maybe ?

        return view('modules.transaksi.transaksi_detail', $data);
    }

    public function testing(){
        // $detil = DetilTransaksi::find(5016)->inventori;
        $detils = DetilTransaksi::all()->where('id_transaksi', 5016);

        // $detils = DetilTransaksi::findOrFail(5016)->tipe_barang;
        // $inven = Inventori::findOrFail($detils)->id_merk;
        // $merk = Merk::findOrFail($inven)->merk;

        // $detil = DetilTransaksi::find(5016)->inventori;
        $detil = Transaksi::find(5016)->detil_transaksi;
        // $detil2 = DetilTransaksi::all()->where

        $harga_modal = DetilTransaksi::leftJoin('inventori',
                                                    'detil_transaksi.tipe_barang',
                                                    '=',
                                                    'inventori.tipe_brg')
                                        ->leftJoin('transaksi',
                                                    'detil_transaksi.id_transaksi',
                                                    '=',
                                                    'transaksi.id_transaksi')
                                        ->where('detil_transaksi.id_transaksi', 5016)
                                        ->select([
                                                'transaksi.id_transaksi',
                                                'inventori.tipe_brg AS tipe_barang',
                                                'inventori.jumlah',
                                                'inventori.harga_barang AS harga',
                                            ])
                                        ->get();


        return $detil;
    }

    public function getNoNota(){
        // $detil = DetilTransaksi::find(5016)->inventori;
        $detils = DetilTransaksi::select('detil_transaksi.id_transaksi')
                                    ->orderBy('detil_transaksi.id_transaksi', 'desc')
                                    ->limit(1)
                                    ->get();

        return $detils;
    }

    public function testlg(){
        $days = date('j');
        echo $days;
    }

    public function test123(){
        $gajis = DetilTransaksi::leftJoin('transaksi',
                                    'detil_transaksi.id_transaksi',
                                    '=',
                                    'transaksi.id_transaksi')
                                ->leftJoin('karyawan',
                                    'transaksi.id_karyawan',
                                    '=',
                                    'karyawan.id_karyawan')
                                ->leftJoin('gaji_karyawan',
                                    'karyawan.id_karyawan',
                                    '=',
                                    'gaji_karyawan.id_karyawan')
                                ->select([
                                    'karyawan.id_karyawan',
                                    'karyawan.nama_karyawan',
                                    DB::raw('SUM(detil_transaksi.harga_total) as penjualan'),
                                    DB::raw('SUM((gaji_karyawan.gaji + gaji_karyawan.bonus - gaji_karyawan.denda)) as gaji_pokok'),
                                ])
                                ->where('transaksi.id_jenis_transaksi', 1)
                                ->groupBy('transaksi.id_karyawan')
                                ->get();

        $presensi = Presensi::leftJoin('karyawan',
                                    'presensi_karyawan.id_karyawan',
                                    '=',
                                    'karyawan.id_karyawan')
                                ->select([
                                    'karyawan.id_karyawan',
                                    'karyawan.nama_karyawan',
                                    DB::raw('COUNT(presensi_karyawan.id_karyawan) AS masuk'),
                                ])
                                ->groupBy('karyawan.nama_karyawan')
                                ->get();

        $test = array_merge(json_decode($gajis),json_decode($presensi));

        return $test;
    }

    public function testers(){
        $today_date = date("Y-m-d");

        $penjualan = Transaksi::select([
                                        DB::raw('COUNT(transaksi.id_jenis_transaksi) as penjualans')
                                    ])
                                ->where('transaksi.id_jenis_transaksi', 1)
                                ->where('transaksi.tanggal_transaksi', $today_date)
                                ->pluck('penjualans');

        $keuntungan = DetilTransaksi::leftJoin('transaksi',
                                    'detil_transaksi.id_transaksi',
                                    '=',
                                    'transaksi.id_transaksi')
                                ->select([
                                            DB::raw('SUM(detil_transaksi.harga - detil_transaksi.harga_modal) * detil_transaksi.jumlah as penjualan')
                                        ])
                                ->where('transaksi.tanggal_transaksi', $today_date)
                                ->where('transaksi.id_jenis_transaksi', 1)
                                ->get();

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


        return $presensi;
    }

    public function hitGaji(){
        $result = [];

        $days = date('j'); //return total days passed in this month
        $days2 = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y')); //return total days in this month

        $data =  Karyawan::select('karyawan.id_karyawan')->get();
        
        $nilai_sanksi = Pengaturan::find(1);

        $counter = count($data);

        // $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        for ($x = 0; $x < $counter; $x++) {
            $subQuery= Presensi::leftJoin('karyawan',
                                            'presensi_karyawan.id_karyawan',
                                            '=',
                                            'karyawan.id_karyawan')
                                        ->where('presensi_karyawan.id_karyawan', $data[$x]->id_karyawan)
                                        ->groupBy('presensi_karyawan.id_karyawan')
                                        ->selectRaw('IFNULL(COUNT(presensi_karyawan.id_karyawan), 0) AS attend');

            $query=  DetilTransaksi::leftJoin('transaksi',
                                                'detil_transaksi.id_transaksi',
                                                '=',
                                                'transaksi.id_transaksi')
                                        ->leftJoin('karyawan',
                                                'transaksi.id_karyawan',
                                                '=',
                                                'karyawan.id_karyawan')
                                        ->leftJoin('gaji_karyawan',
                                                'karyawan.id_karyawan',
                                                '=',
                                                'gaji_karyawan.id_karyawan')
                                        ->select([
                                                'karyawan.nama_karyawan',
                                                DB::raw('SUM(detil_transaksi.harga - detil_transaksi.harga_modal)*0.1 as penjualan'),
                                                DB::raw('(gaji_karyawan.gaji + gaji_karyawan.bonus + gaji_karyawan.uang_makan - gaji_karyawan.denda) as gaji_pokok'),
                                                DB::raw(' ifnull(( ' . $subQuery->toSql() . ' ),0) * '. $nilai_sanksi->nilai_pengaturan .' AS presensi '),
                                                DB::raw('@total:= ifnull(( ' . $subQuery->toSql() . ' ),0) * '. $nilai_sanksi->nilai_pengaturan .' + (gaji_karyawan.gaji + gaji_karyawan.bonus + gaji_karyawan.uang_makan - gaji_karyawan.denda) + (SUM(detil_transaksi.harga - detil_transaksi.harga_modal)*0.1) AS total')
                                            ])->mergeBindings($subQuery->getQuery())->mergeBindings($subQuery->getQuery())
                                        ->where('transaksi.id_jenis_transaksi', 1)
                                        ->where('transaksi.id_karyawan', $data[$x]->id_karyawan)
                                        ->groupBy('transaksi.id_karyawan')
                                       ;
                                
                foreach ($query->get() as $datas) {
                    $result[] = ["nama_karyawan" => $datas->nama_karyawan, 
                                    "penjualan" => number_format($datas->penjualan, 2, ",", "."), 
                                    "gaji_pokok" =>number_format($datas->gaji_pokok, 2, ",", "."),
                                    "presensi" =>number_format($datas->presensi, 2, ",", "."),
                                    "total" => number_format($datas->total, 2, ",", ".")];
                }
        }
                      // echo json_encode($result);
                      // die;       
        $result = collect($result);
        return Datatables::of($result)
        ->make(true);

    }

    public function hitGajiBulanan($month){
        $result = [];

        $days = date('j'); //return total days passed in this month
        $days2 = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y')); //return total days in this month

        $data =  Karyawan::select('karyawan.id_karyawan')->get();
        
        $nilai_sanksi = Pengaturan::find(1);

        $counter = count($data);

        // $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        for ($x = 0; $x < $counter; $x++) {
            $subQuery= Presensi::leftJoin('karyawan',
                                            'presensi_karyawan.id_karyawan',
                                            '=',
                                            'karyawan.id_karyawan')
                                        ->where('presensi_karyawan.id_karyawan', $data[$x]->id_karyawan)
                                        ->groupBy('presensi_karyawan.id_karyawan')
                                        ->selectRaw('IFNULL(COUNT(presensi_karyawan.id_karyawan), 0) AS attend');

            $query=  DetilTransaksi::leftJoin('transaksi',
                                                'detil_transaksi.id_transaksi',
                                                '=',
                                                'transaksi.id_transaksi')
                                        ->leftJoin('karyawan',
                                                'transaksi.id_karyawan',
                                                '=',
                                                'karyawan.id_karyawan')
                                        ->leftJoin('gaji_karyawan',
                                                'karyawan.id_karyawan',
                                                '=',
                                                'gaji_karyawan.id_karyawan')
                                        ->select([
                                                'karyawan.nama_karyawan',
                                                DB::raw('SUM(detil_transaksi.harga - detil_transaksi.harga_modal)*0.1 as penjualan'),
                                                DB::raw('(gaji_karyawan.gaji + gaji_karyawan.bonus + gaji_karyawan.uang_makan - gaji_karyawan.denda) as gaji_pokok'),
                                                DB::raw(' ifnull(( ' . $subQuery->toSql() . ' ),0) * '. $nilai_sanksi->nilai_pengaturan .' AS presensi '),
                                                DB::raw('@total:= ifnull(( ' . $subQuery->toSql() . ' ),0) * '. $nilai_sanksi->nilai_pengaturan .' + (gaji_karyawan.gaji + gaji_karyawan.bonus + gaji_karyawan.uang_makan - gaji_karyawan.denda) + (SUM(detil_transaksi.harga - detil_transaksi.harga_modal)*0.1) AS total')
                                            ])->mergeBindings($subQuery->getQuery())->mergeBindings($subQuery->getQuery())
                                        ->where('transaksi.id_jenis_transaksi', 1)
                                        ->where('transaksi.id_karyawan', $data[$x]->id_karyawan)
                                        ->whereMonth('transaksi.tanggal_transaksi', "=", $month)
                                        ->groupBy('transaksi.id_karyawan')
                                       ;
                                
                foreach ($query->get() as $datas) {
                    $result[] = ["nama_karyawan" => $datas->nama_karyawan, 
                                    "penjualan" => number_format($datas->penjualan, 2, ",", "."), 
                                    "gaji_pokok" =>number_format($datas->gaji_pokok, 2, ",", "."),
                                    "presensi" =>number_format($datas->presensi, 2, ",", "."),
                                    "total" => number_format($datas->total, 2, ",", ".")];
                }
        }
                      // echo json_encode($result);
                      // die;       
        $result = collect($result);
        return $result;

    }
}
