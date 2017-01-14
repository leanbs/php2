<?php

namespace App\Http\Controllers;

use Log;
use DB;
use Redirect;

use Datatables;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;

use App\Hutang;
use App\Karyawan;

class HutangController extends Controller
{
    /**
     * Validation rule for account creation.
     *
     * @var array
     */
    protected $rules = [
        'id_hutang'   => 'unique',
        'hutang' => 'required|max:50',
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
        return view('modules.hutang.hutang');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hutangs = Hutang::leftJoin('karyawan',
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
                            ]);

        return Datatables::of($hutangs)
            ->addColumn('Action', function ($hutang) {
                $urlEdit = url('/hutang/' . $hutang['id_hutang'] . '/edit');
                $urlDelete = url('/hutang/' . $hutang['id_hutang']);

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
            ->editColumn('status', function ($hutang) {
                $urlEdit = url('/hutang/status_lns/' . $hutang['id_hutang']);
                $icon = ($hutang['status'] ? 'check' : 'times');
                $label = ($hutang['status'] ? 'Sudah' : 'Belum');

                return '<i class="fa fa-' . $icon . '"></i> '. $label .
                        '<br/> <a href="' . $urlEdit . '" id="status" class="action-edit link-yellow"
                        data-toggle="tooltip" title="Klik untuk mengubah data">
                        <i class="fa fa-refresh"></i>
                        Ubah
                        </a>';
            })
            ->editColumn('hutang', function ($hutang) {
                return number_format($hutang->hutang, 2, ",", ".");
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
        $data['hutang'] = new Hutang;
        $data['karyawan'] = Karyawan::lists('nama_karyawan', 'id_karyawan');

        return view('modules.hutang.create', $data);
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

        $id_hutang = $request->input('id_hutang');
        $hutang = floatval(str_replace(".","", $request->input('hutang')));
        $id_karyawan = $request->input('id_karyawan');
        $jangka_waktu = $request->input('jangka_waktu');
        $keterangan = $request->input('keterangan');


        $hutangs = Hutang::create([
                'id_hutang'        => $id_hutang,
                'hutang'           => $hutang,
                'id_karyawan'      => $id_karyawan,
                'jangka_waktu'     => $jangka_waktu,
                'keterangan'       => $keterangan,
            ]);
        $hutangs->status = 0;

        return response()->json([
            'success' => trans('action.success.add'),
        ]);
    }

        /**
     * Display the specified resource.
     *
     * @param  string  $id_hutang
     * @return \Illuminate\Http\Response
     */
    public function show($id_hutang)
    {
        try {
            $hutangs = Hutang::findOrFail($id_hutang);
            $data['hutang'] = $hutangs;
            $data['karyawan'] = Karyawan::lists('nama_karyawan', 'id_karyawan');

            return view('modules.hutang.delete', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id_hutang
     * @return \Illuminate\Http\Response
     */
    public function edit($id_hutang)
    {
        try {
            $hutangs = Hutang::findOrFail($id_hutang);
            $data['hutang'] = $hutangs;
            $data['karyawan'] = Karyawan::lists('nama_karyawan', 'id_karyawan');

            return view('modules.hutang.edit', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id_hutang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_hutang)
    {
        // Copy base rules.
        $rulesExtra = $this->rules;
        // Add extra rule, must be unique except for the currently edited.
        $rulesExtra['id_hutang'] .= ',' . $id_hutang . ',id_hutang';
        // Validate request.
        $this->validate($request, $rulesExtra);

        // $id_hutang = $request->input('id_hutang');
        $hutangs = floatval(str_replace(".","", $request->input('hutang')));
        $id_karyawan = $request->input('id_karyawan');
        $jangka_waktu = $request->input('jangka_waktu');
        $keterangan = $request->input('keterangan');

        try {
            $hutang = Hutang::findOrFail($id_hutang);

            $hutang->update([
                'id_hutang'        => $id_hutang,
                'hutang'           => $hutangs,
                'id_karyawan'      => $id_karyawan,
                'jangka_waktu'     => $jangka_waktu,
                'keterangan'       => $keterangan,
                ]);

            return response()->json([
                // 'success' => $hutangs,
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
     * @param  string  $id_hutang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_hutang)
    {
        try {
            $hutangs = Hutang::findOrFail($id_hutang);

            $hutangs->delete();

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

    public function statusHutangChanger($id_hutang)
    {
        DB::statement('UPDATE hutang_karyawan SET status = IF (status, 0, 1) WHERE id_hutang ='. $id_hutang );
        return Redirect::back();
    }
}
