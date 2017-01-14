<?php

namespace App\Http\Controllers;

use Log;
use Datatables;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Presensi;
use App\Karyawan;

class PresensiController extends Controller
{
    /**
     * Validation rule for account creation.
     *
     * @var array
     */
    protected $rules = [
        'id_karyawan'   => 'required|max:10',
        'tgl_presensi'   => 'required',
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
        return view('modules.presensi.presensi');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presensis = Presensi::leftJoin('karyawan',
                                        'presensi_karyawan.id_karyawan',
                                        '=',
                                        'karyawan.id_karyawan')
                                ->select([
                                    'presensi_karyawan.id_presensi',
                                    'presensi_karyawan.id_karyawan',
                                    'karyawan.nama_karyawan',
                                    'presensi_karyawan.tgl_presensi',
                                    'presensi_karyawan.jam_hadir',
                                    'presensi_karyawan.status_hadir',
                                    'presensi_karyawan.keterangan',
                                ]);

        return Datatables::of($presensis)
            ->addColumn('Action', function ($presensi) {
                $urlEdit = url('/presensi/' . $presensi['id_presensi'] . '/edit');
                $urlDelete = url('/presensi/' . $presensi['id_presensi']);

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
            ->editColumn('status_hadir', function ($presensi) {
                $urlEdit = url('/transaksi/status_byr/' . $presensi['id_presensi']);
                $icon = ($presensi['status_hadir'] ? 'check' : 'times');
                $label = ($presensi['status_hadir'] ? 'Sudah' : 'Belum');

                return '<i class="fa fa-' . $icon . '"></i> '. $label ;
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
        $data['presensi'] = new Presensi;
        $data['karyawan'] = Karyawan::lists('nama_karyawan', 'id_karyawan');

        return view('modules.presensi.create', $data);
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

        $presensi = Presensi::create($request->all());

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
            $presensi = Presensi::findOrFail($id_karyawan);
            $data['presensi'] = $presensi;
            $data['karyawan'] = Karyawan::lists('nama_karyawan', 'id_karyawan');

            return view('modules.presensi.delete', $data);
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
            $presensi = Presensi::findOrFail($id_karyawan);
            $data['presensi'] = $presensi;
            $data['karyawan'] = Karyawan::lists('nama_karyawan', 'id_karyawan');

            return view('modules.presensi.edit', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');
            echo $e;
            die;

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
        // Copy base rules.
        $rulesExtra = $this->rules;
        // Add extra rule, must be unique except for the currently edited.
        $rulesExtra['id_karyawan'] .= ',' . $id_karyawan . ',id_karyawan';
        // Validate request.
        $this->validate($request, $rulesExtra);

        try {
            $inventori = Presensi::findOrFail($id_karyawan);

            $inventori->update($request->all());

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
            $inventori = Presensi::findOrFail($id_karyawan);

            $inventori->delete();

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
     * Display page to manage current resource.
     *
     * @return Response
     */
    public function getPresensiView()
    {
        $today = Carbon::now('Asia/Jakarta')->format('Y-m-d');
    	$data['karyawan'] = Karyawan::lists('nama_karyawan', 'id_karyawan');
        $data['selected'] = Presensi::select([
                                    'presensi_karyawan.id_karyawan',
                                    'presensi_karyawan.status_hadir',
                                    ])
                            ->where('presensi_karyawan.tgl_presensi', $today)
                            ->where('presensi_karyawan.status_hadir', '1')
                            ->get();
        //SELECT presensi_karyawan.id_karyawan, presensi_karyawan.status_hadir FROM `presensi_karyawan` WHERE tgl_presensi = '2017-01-13' AND status_hadir = 1
        // lists('status_hadir', 'id_karyawan');


        return view('modules.presensi.masuk', $data);
    }


    public function getPresensiCbx()
    {
        $presensi = Karyawan::select([
                                    'karyawan.id_karyawan',
                                    'karyawan.nama_karyawan',
                                ])
        						->get();

        return $presensi;

        // return Datatables::of($presensi)
        // ->make(true); 
    }

    public function makePresensiData()
    {
    	$today = Carbon::now('Asia/Jakarta')->format('Y-m-d');
    	$time_now = Carbon::now('Asia/Jakarta')->format('H:i:s');
    	$presensi = Karyawan::select([
                                    'karyawan.id_karyawan',
                                    'karyawan.nama_karyawan',
                                ]);

        $counter = count($presensi->get());

        foreach ($presensi->get() as $data) {
            Presensi::insert([
			    ['id_karyawan' => $data->id_karyawan, 
			     'tgl_presensi' => $today,
			     'jam_hadir' => '00:00:00', 
			     'status_hadir' => 0,
			     'keterangan' => '-'],
			]);
        }

        return $counter;
    }

    public function setPresensiData()
    {
    	$today = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $time_now = Carbon::now('Asia/Jakarta')->format('H:i:s');
        $input = Input::all();
        $yes = $input['karyawan'];

            foreach ($yes as $data) {
                DB::statement('UPDATE `presensi_karyawan` SET jam_hadir = "'. $time_now .'", status_hadir = 1 WHERE id_karyawan = "'. $data .'" AND tgl_presensi= "'. $today .'" AND status_hadir = 0 ');
            }

        return $yes;
    }

    public function fortesting()
    {
    	$today = Carbon::now('Asia/Jakarta')->format('Y-m-d');
    	$time_now = Carbon::now('Asia/Jakarta')->format('H:i:s');
    	$input = Input::all();
    	$yes = $input['karyawan'];

        	foreach ($yes as $data) {
        		DB::statement('UPDATE `presensi_karyawan` SET jam_hadir = "'. $time_now .'", status_hadir = 1 WHERE id_karyawan = "'. $data .'" AND tgl_presensi= "'. $today .'" AND status_hadir = 0 ');
        	}

        return $yes;
    }

    public function searchPerDatatable($month, $year)
    {
        $presensis = Presensi::leftJoin('karyawan',
                                        'presensi_karyawan.id_karyawan',
                                        '=',
                                        'karyawan.id_karyawan')
                                ->select([
                                    'presensi_karyawan.id_presensi',
                                    'presensi_karyawan.id_karyawan',
                                    'karyawan.nama_karyawan',
                                    'presensi_karyawan.tgl_presensi',
                                    'presensi_karyawan.jam_hadir',
                                    'presensi_karyawan.status_hadir',
                                    'presensi_karyawan.keterangan',
                                ])
                                ->whereMonth('presensi_karyawan.tgl_presensi', '=', '01');

        return Datatables::of($presensis)
            ->editColumn('status_hadir', function ($presensi) {
                $urlEdit = url('/transaksi/status_byr/' . $presensi['id_presensi']);
                $icon = ($presensi['status_hadir'] ? 'check' : 'times');
                $label = ($presensi['status_hadir'] ? 'Sudah' : 'Belum');

                return '<i class="fa fa-' . $icon . '"></i> '. $label ;
            })
            ->make(true);
    }
    
}

