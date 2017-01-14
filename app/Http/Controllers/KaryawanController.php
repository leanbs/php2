<?php

namespace App\Http\Controllers;

use Log;
use Datatables;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Karyawan;
use App\JenisKelamin;
use App\Toko;

class KaryawanController extends Controller
{
    /**
     * Validation rule for account creation.
     *
     * @var array
     */
    protected $rules = [
        'id_karyawan'   => 'unique:karyawan,id_karyawan',
        'nama_karyawan' => 'required|max:50',
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
        return view('modules.karyawan.karyawan');
    }


    public function manage_hutang()
    {
        return view('modules.hutang.hutang');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawans = Karyawan::leftJoin('master_toko',
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
                                ]);

        return Datatables::of($karyawans)
            ->addColumn('Action', function ($karyawan) {
                $urlEdit = url('/karyawan/' . $karyawan['id_karyawan'] . '/edit');
                $urlDelete = url('/karyawan/' . $karyawan['id_karyawan']);

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
            ->editColumn('karyawan.nama_karyawan', function ($transaksi) {
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
            ->make(true);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['karyawan'] = new Karyawan;
        $data['jns_kelamin'] = JenisKelamin::lists('jns_kelamin', 'id_jns_kelamin');
        $data['toko'] = Toko::lists('nama_toko', 'id_toko');

        return view('modules.karyawan.create', $data);
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

        $karyawan = Karyawan::create($request->all());

        return response()->json([
            'success' => trans('action.success.add'),
        ]);
    }

        /**
     * Display the specified resource.
     *
     * @param  string  $id_karyawan
     * @return \Illuminate\Http\Response
     */
    public function show($id_karyawan)
    {
        try {
            $data['karyawan'] = Karyawan::findOrFail($id_karyawan);
            $data['jns_kelamin'] = JenisKelamin::lists('jns_kelamin', 'id_jns_kelamin');
            $data['toko'] = Toko::lists('nama_toko', 'id_toko');

            return view('modules.karyawan.delete', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id_karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit($id_karyawan)
    {
        try {
            $data['karyawan'] = Karyawan::findOrFail($id_karyawan);
            $data['jns_kelamin'] = JenisKelamin::lists('jns_kelamin', 'id_jns_kelamin');
            $data['toko'] = Toko::lists('nama_toko', 'id_toko');


            return view('modules.karyawan.edit', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id_karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_karyawan)
    {
        // Copy base rules.
        $rulesExtra = $this->rules;
        // Add extra rule, must be unique except for the currently edited.
        $rulesExtra['id_karyawan'] .= ',' . $id_karyawan . ',id_karyawan';
        // Validate request.
        $this->validate($request, $rulesExtra);

        try {
            $karyawan = Karyawan::findOrFail($id_karyawan);

            $karyawan->update($request->all());

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
     * @param  string  $id_karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_karyawan)
    {
        try {
            $karyawan = Karyawan::findOrFail($id_karyawan);

            $karyawan->delete();

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKaryawan()
    {
        $inventoris = Karyawan::select([
                                    'karyawan.id_karyawan',
                                    'karyawan.nama_karyawan',
                                ])
                                ->get();

        return $inventoris;
    }
}
