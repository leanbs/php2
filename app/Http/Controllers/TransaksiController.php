<?php

namespace App\Http\Controllers;

use DB;
use Redirect;

use Datatables;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Transaksi;
use App\JenisTransaksi;
use App\Http\Requests\TransaksiPostRequest;

class TransaksiController extends Controller
{
    /**
     * Validation rule for account creation.
     *
     * @var array
     */
    protected $rules = [
        'id_jenis_transaksi'   => 'required',
        
    ];

    /**
     * Constructor.
     */
    public function __construct()
    {
        
    }

    /**
     * Display page to manage current resource.
     *
     * @return Response
     */
    public function manage()
    {
        return view('modules.transaksi.transaksi');
    }

    public function getTopTenSell()
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
    							->groupBy('inventori.tipe_brg')
    							->limit(10)
    							->get();

    	return $transaksis;
    }

    public function getTopTenBuy()
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
                                ->groupBy('inventori.tipe_brg')
                                ->limit(10)
                                ->get();

        return $transaksis;
    }


    public function getMonthlySale()
    {
        $month = Carbon::now()->month;

        $data_months = [];

        $proc = [];

        for ($i = 1; $i <= $month ; $i++) {
                    array_push($data_months, $i);

    	$transaksis = Transaksi::leftJoin('detil_transaksi',
    									'transaksi.id_transaksi',
    									'=',
    									'detil_transaksi.transaksi')
    							->leftJoin('karyawan',
    									'transaksi.id_karyawan',
    									'=',
    									'karyawan.id_karyawan')
    							->leftJoin('master_toko',
    									'karyawan.id_toko',
    									'=',
    									'master_toko.id_toko')
    							->select([
    									'master_toko.nama_toko',
    									DB::raw('COUNT(transaksi.id_jenis_transaksi) AS jumlah'),
    								])
    							->whereRaw('EXTRACT(MONTH FROM detil_transaksi.tanggal_transaksi) ='.$i)
    							->groupBy('master_toko.nama_toko');

            foreach ($transaksis->get() as $data) {
                if (array_key_exists($data->nama_toko, $proc)) {
                    array_push($proc[$data->nama_toko], $data->jumlah);
                } else {
                    $proc[$data->nama_toko] = [ $data->jumlah ];
                }
            }
        }

        // Years information.
                $result['Month'] = $data_months;
                // Add previously computed statuses' stats for each year, into
                // result container.
                foreach ($proc as $status => $arrayData) {
                    $result[$status] = $arrayData;
                } 

    	return response()->json($result);
    }

    public function getMonthlySales(){
        $result = [];

        $jenis_transaksis = JenisTransaksi::leftJoin('transaksi',
                                            'jenis_transaksi.id_jenis_transaksi',
                                            '=',
                                            'transaksi.id_jenis_transaksi')
                                            ->select([
                                                    'jenis_transaksi.jenis_transaksi',
                                                    DB::raw('COUNT(transaksi.id_transaksi) AS jumlah'),
                                                ])
                                            ->groupBy('jenis_transaksi.jenis_transaksi');

            foreach ($jenis_transaksis->get() as $data) {
                    array_push($result, [ $data->jenis_transaksi => $data->jumlah ]);
                }

        return response()->json($result);
    }

    public function index()
    {
        $transaksis = Transaksi::leftJoin('jenis_transaksi',
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
                                ]);

        return Datatables::of($transaksis)
	        ->editColumn('id_transaksi', function ($transaksi) {
	                $url = url('/transaksi/view/' . $transaksi['id_transaksi']);
	                return '<a href="' . $url . '" data-modal="">' . $transaksi['id_transaksi'] . '</a>';
	            })
	        ->editColumn('status_bayar', function ($transaksi) {
                $urlEdit = url('/transaksi/status_byr/' . $transaksi['id_transaksi']);
                $icon = ($transaksi['status_bayar'] ? 'check' : 'times');
                $label = ($transaksi['status_bayar'] ? 'Sudah' : 'Belum');

                return '<i class="fa fa-' . $icon . '"></i> '. $label .
                        '<br/> <a href="' . $urlEdit . '" id="stat_byr" class="action-edit link-yellow"
                        data-toggle="tooltip" title="Klik untuk mengubah data">
                        <i class="fa fa-refresh"></i>
                        Ubah
                        </a>';
            })
            ->editColumn('status_kirim', function ($transaksi) {
                $urlEdit = url('/transaksi/status_krm/' . $transaksi['id_transaksi']);
                $icon = ($transaksi['status_kirim'] ? 'check' : 'times');
                $label = ($transaksi['status_kirim'] ? 'Sudah' : 'Belum');

                return '<i class="fa fa-' . $icon . '"></i> '. $label  .
                        '<br/> <a href="' . $urlEdit . '" id="stat_krm" class="action-edit link-yellow"
                        data-toggle="tooltip" title="Klik untuk mengubah data">
                        <i class="fa fa-refresh"></i>
                        Ubah
                        </a>';
            })
            ->make(true);
    }

    public function getTransaksiLists()
    {
        $transaksis = Transaksi::leftJoin('jenis_transaksi',
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
                                ->get();
        return $transaksis;
    }

    public function statusBayar($id_transaksi)
    {
        DB::statement('UPDATE transaksi SET status_bayar = IF (status_bayar, 0, 1) WHERE id_transaksi ='. $id_transaksi );
        return Redirect::back();
    }

    public function statusKirim($id_transaksi)
    {
        DB::statement('UPDATE transaksi SET status_kirim = IF (status_kirim, 0, 1) WHERE id_transaksi ='. $id_transaksi );
        return Redirect::back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransaksiPostRequest $request)
    {
        $this->validate($request, $this->rules);

        $transaksis = Transaksi::create($request->all());

        return response()->json([
            'success' => trans('action.success.add'),
        ]);
    }

    public function updateInventory($stok, $tipe_brg, $operator){ 
        DB::statement('UPDATE `inventori` SET `jumlah`= jumlah '. $operator .' '. $stok .' WHERE tipe_brg = "'. $tipe_brg .'"' );
        
        return response()->json([
            'success' => trans('action.success.add'),
        ]);
    }
}
