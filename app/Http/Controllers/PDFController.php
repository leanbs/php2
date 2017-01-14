<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use PDF;

use App\Transaksi;
use App\Inventori;
use App\Karyawan;
use App\GajiKaryawan;
use App\Hutang;
use App\Pengaturan;
use App\Presensi;
use App\DetilTransaksi;

class PDFController extends Controller
{
    public function getTransaksiReportMonthly(){
    	$this_month = date("m");

    	$transaksi = Transaksi::leftJoin('jenis_transaksi',
                                        'transaksi.id_jenis_transaksi',
                                        '=',
                                        'jenis_transaksi.id_jenis_transaksi')
                                ->leftJoin('karyawan',
                                    'transaksi.id_karyawan',
                                    '=',
                                    'karyawan.id_karyawan')
                                ->select([
                                    'transaksi.id_transaksi',
                                    'jenis_transaksi.jenis_transaksi',
                                    'karyawan.nama_karyawan',
                                    'transaksi.nama_pelanggan',
                                    'transaksi.alamat',
                                    'transaksi.nomor_telp',
                                    'transaksi.tanggal_transaksi',
                                    'transaksi.status_kirim',
                                    'transaksi.status_bayar',
                                ])
                                ->where( DB::raw('MONTH(transaksi.tanggal_transaksi)'), '=', date('n'))
                                ->get();

    	$pdf = PDF::loadView('pdf.transaksi', ['transaksi' => $transaksi]);
    	return $pdf->stream('transaksi.pdf');
    }

    public function getInventoryReport(){
    	$inventori = Inventori::leftJoin('master_merk',
                                        'master_merk.id_merk',
                                        '=',
                                        'inventori.id_merk')
                                ->leftJoin('master_kategori',
                                    'master_kategori.id_kategori',
                                    '=',
                                    'inventori.id_kategori')
                                ->select([
                                    'inventori.tipe_brg',
                                    'master_merk.merk',
                                    'master_kategori.kategori',
                                    'inventori.harga_barang',
                                    'inventori.jumlah',
                                ])
                                ->get();
    	$pdf = PDF::loadView('pdf.inventori', ['inventori' => $inventori]);
    	return $pdf->stream('inventori.pdf');
    }

    public function getKaryawanReport(){
    	$karyawan = Karyawan::leftJoin('master_toko',
                                        'master_toko.id_toko',
                                        '=',
                                        'karyawan.id_toko')
                                ->leftJoin('jns_kelamin',
                                    'jns_kelamin.id_jns_kelamin',
                                    '=',
                                    'karyawan.id_jns_kelamin')
                                ->select([
                                    'karyawan.id_karyawan',
                                    'master_toko.nama_toko',
                                    'karyawan.nama_karyawan',
                                    'jns_kelamin.jns_kelamin',
                                    'karyawan.tempat_lhr',
                                    'karyawan.tgl_lhr',
                                    'karyawan.alamat',
                                    'karyawan.nomor_telp',
                                ])
                                ->get();
    	$pdf = PDF::loadView('pdf.karyawan', ['karyawan' => $karyawan]);
    	return $pdf->stream('karyawan.pdf');
    }

    public function getGajiReport(){
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
                                                DB::raw('SUM(detil_transaksi.harga - detil_transaksi.harga_modal) as penjualan'),
                                                DB::raw('gaji_karyawan.jumlah_gaji as gaji_pokok'),
                                                DB::raw(' ifnull(( ' . $subQuery->toSql() . ' ),0) * '. $nilai_sanksi->nilai_pengaturan .' AS presensi '),
                                                DB::raw('@total:= ifnull(( ' . $subQuery->toSql() . ' ),0) * '. $nilai_sanksi->nilai_pengaturan .' + gaji_karyawan.jumlah_gaji + SUM(detil_transaksi.harga - detil_transaksi.harga_modal) AS total')
                                            ])->mergeBindings($subQuery->getQuery())->mergeBindings($subQuery->getQuery())
                                        ->where('transaksi.id_jenis_transaksi', 1)
                                        ->where('transaksi.id_karyawan', $data[$x]->id_karyawan)
                                        ->groupBy('transaksi.id_karyawan')
                                       ;
                                
                foreach ($query->get() as $datas) {
                    $result[] = ["nama_karyawan" => $datas->nama_karyawan, 
                                    "penjualan" => $datas->penjualan, 
                                    "gaji_pokok" =>$datas->gaji_pokok,
                                    "presensi" =>$datas->presensi,
                                    "total" => $datas->total];
                }
        }
                      // echo json_encode($result);
                      // die;       
        $result = collect($result);
        var_dump($result);
    	$pdf = PDF::loadView('pdf.gaji', ['gaji' => $result]);
    	return $pdf->stream('gaji.pdf');
    }

    public function getGajiReportMonthly($month){
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
                                    "penjualan" => $datas->penjualan, 
                                    "gaji_pokok" =>$datas->gaji_pokok,
                                    "presensi" =>$datas->presensi,
                                    "total" => $datas->total];
                }
        }
                      // echo json_encode($result);
                      // die;       
        $result = collect($result);

        $pdf = PDF::loadView('pdf.gaji-bulanan', ['gaji' => $result]);
        return $pdf->stream('gaji-bulanan.pdf');
    }

    public function getHutangReport(){
    	$hutang = Hutang::leftJoin('karyawan',
                                    'hutang_karyawan.id_karyawan',
                                    '=',
                                    'karyawan.id_karyawan')
                            ->select([
                                'hutang_karyawan.id_hutang',
                                'karyawan.nama_karyawan',
                                'hutang_karyawan.hutang',
                                'hutang_karyawan.jangka_waktu',
                                'hutang_karyawan.keterangan',
                                'hutang_karyawan.status',
                            ])
                            ->get();
    	$pdf = PDF::loadView('pdf.hutang', ['hutang' => $hutang]);
    	return $pdf->stream('hutang.pdf');
    }
}
