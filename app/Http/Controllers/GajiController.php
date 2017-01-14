<?php

namespace App\Http\Controllers;

use DB;
use Datatables;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\DetilTransaksi;
use App\GajiKaryawan;
use App\Karyawan;

class GajiController extends Controller
{
    /**
     * Validation rule for account creation.
     *
     * @var array
     */
    protected $rules = [
        'id_karyawan'   => 'required',
    ];

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display page to manage current resource.
     *
     * @return Response
     */
    public function manage()
    {
        return view('modules.gaji.gaji');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gajis = GajiKaryawan::leftJoin('karyawan',
                                    'gaji_karyawan.id_karyawan',
                                    '=',
                                    'karyawan.id_karyawan')
                                ->select([
                                    'karyawan.nama_karyawan',
                                    'gaji_karyawan.id_karyawan',
                                    'gaji_karyawan.gaji',
                                    'gaji_karyawan.bonus',
                                    'gaji_karyawan.denda',
                                    'gaji_karyawan.uang_makan',
                                    DB::raw('(gaji_karyawan.gaji + gaji_karyawan.bonus + gaji_karyawan.uang_makan - gaji_karyawan.denda) as jumlah_gaji'),
                                ]);

        return Datatables::of($gajis)
            ->addColumn('Action', function ($gaji) {
                $urlEdit = url('/gaji/' . $gaji['id_karyawan'] . '/edit');
                $urlDelete = url('/gaji/' . $gaji['id_karyawan']);

                return
                    '<a href="' . $urlEdit . '" data-modal="" class="action-edit link-yellow"
                        data-toggle="tooltip" title="Klik untuk mengubah data">
                        <i class="fa fa-pencil"></i>
                        Edit
                    </a>
                    &nbsp;
                    <a href="' . $urlDelete . '" data-modal="" class="action-delete link-red"
                        data-toggle="tooltip" title="Klik untuk menghapus data">
                        <i class="fa fa-trash"></i>
                        Delete
                    </a>';
            })
            ->editColumn('gaji', function ($gaji) {
                return number_format($gaji->gaji, 2, ",", ".");
            })
            ->editColumn('bonus', function ($gaji) {
                return number_format($gaji->bonus, 2, ",", ".");
            })
            ->editColumn('denda', function ($gaji) {
                return number_format($gaji->denda, 2, ",", ".");
            })
            ->editColumn('uang_makan', function ($gaji) {
                return number_format($gaji->uang_makan, 2, ",", ".");
            })
            ->editColumn('jumlah_gaji', function ($gaji) {
                return number_format($gaji->jumlah_gaji, 2, ",", ".");
            })
            ->make(true);
    }

    public function viewGaji()
    {
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
                                    DB::raw('COUNT(presensi_karyawan.id_karyawan) '),
                                ])
                                ->groupBy('karyawan.nama_karyawan')
                                ->get();

        return Datatables::of($gajis)
            ->addColumn('Action', function ($gaji) {
                $urlEdit = url('/gaji/' . $gaji['id_karyawan'] . '/edit');
                $urlDelete = url('/gaji/' . $gaji['id_karyawan']);

                return
                    '<a href="' . $urlEdit . '" data-modal="" class="action-edit link-yellow"
                        data-toggle="tooltip" title="Klik untuk mengubah data">
                        <i class="fa fa-pencil"></i>
                        Edit
                    </a>
                    &nbsp;
                    <a href="' . $urlDelete . '" data-modal="" class="action-delete link-red"
                        data-toggle="tooltip" title="Klik untuk menghapus data">
                        <i class="fa fa-trash"></i>
                        Delete
                    </a>';
            })
            ->editColumn('gaji_pokok', function ($gaji) {
                return number_format($gaji->gaji_pokok, 2, ",", ".");
            })
            ->editColumn('penjualan', function ($gaji) {
                return number_format($gaji->penjualan, 2, ",", ".");
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['gaji'] = new GajiKaryawan;
        $data['karyawan'] = Karyawan::lists('nama_karyawan', 'id_karyawan');

        return view('modules.gaji.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $gaji = GajiKaryawan::create($request->all());

        return response()->json([
            'success' => trans('action.success.add'),
        ]);
    }

        /**
     * Display the specified resource.
     *
     * @param  string  $tipe_brg
     * @return \Illuminate\Http\Response
     */
    public function show($tipe_brg)
    {
        try {
            $gaji = GajiKaryawan::findOrFail($tipe_brg);
            $data['gaji'] = $gaji;
            $data['karyawan'] = Karyawan::lists('nama_karyawan', 'id_karyawan');
            // $data['kategori'] = Kategori::lists('kategori', 'id_kategori');
            // $data['merk'] = Merk::lists('merk', 'id_merk');

            return view('modules.gaji.delete', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $tipe_brg
     * @return \Illuminate\Http\Response
     */
    public function edit($tipe_brg)
    {
        try {
            $gaji = GajiKaryawan::findOrFail($tipe_brg);
            $data['gaji'] = $gaji;
            $data['karyawan'] = Karyawan::lists('nama_karyawan', 'id_karyawan');
            // $data['kategori'] = Kategori::lists('kategori', 'id_kategori');
            // $data['merk'] = Merk::lists('merk', 'id_merk');

            return view('modules.gaji.edit', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $tipe_brg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_karyawan)
    {
        // // Copy base rules.
        // $rulesExtra = $this->rules;
        // // Add extra rule, must be unique except for the currently edited.
        // $rulesExtra['id_karyawan'] .= ',' . $id_karyawan . ',id_karyawan';
        // // Validate request.
        // $this->validate($request, $rulesExtra);

        try {
            $gaji = GajiKaryawan::findOrFail($id_karyawan);

            $gaji->update($request->all());

            return response()->json([
                'success' => trans('action.success.edit'),
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => trans('action.fail.missing'),
            ]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'error' => trans('action.fail.unknown'),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $tipe_brg
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_karyawan)
    {
        try {
            $gaji = GajiKaryawan::findOrFail($id_karyawan);

            $gaji->delete();

            return response()->json([
                'success' => trans('action.success.delete'),
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => trans('action.fail.missing'),
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'error' => trans('action.fail.forbidden'),
            ]);
        } catch (\Exception $e) {
            Log::error($e);

            return response()->json([
                'error' => trans('action.fail.unknown'),
            ]);
        }
    }
}

