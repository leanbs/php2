<?php

namespace App\Http\Controllers;

use Log;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests;
use App\Toko;
use App\Karyawan;

class TokoController extends Controller
{
    /**
     * Validation rule for account creation.
     *
     * @var array
     */
    protected $rules = [
        'id_toko'   => 'unique',
        'nama_toko' => 'required|max:50',
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
        return view('modules.toko.toko');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tokos = Toko::leftJoin('karyawan',
                                'karyawan.id_karyawan',
                                '=',
                                'master_toko.supervisor')
                    ->select([
                            'master_toko.id_toko',
                            'master_toko.nama_toko',
                            'master_toko.alamat',
                            'karyawan.nama_karyawan',
                            ]);

        return Datatables::of($tokos)
            ->addColumn('Action', function ($toko) {
                $urlEdit = url('/toko/' . $toko['id_toko'] . '/edit');
                $urlDelete = url('/toko/' . $toko['id_toko']);

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
            ->make(true);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['toko'] = new Toko;
        $data['karyawan'] = Karyawan::lists('nama_karyawan', 'id_karyawan');

        return view('modules.toko.create', $data);
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

        $toko = Toko::create($request->all());

        return response()->json([
            'success' => trans('action.success.add'),
        ]);
    }

        /**
     * Display the specified resource.
     *
     * @param  string  $id_toko
     * @return \Illuminate\Http\Response
     */
    public function show($id_toko)
    {
        try {
            $data['toko'] = Toko::findOrFail($id_toko);
            $data['karyawan'] = Karyawan::lists('nama_karyawan', 'id_karyawan');

            return view('modules.toko.delete', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id_toko
     * @return \Illuminate\Http\Response
     */
    public function edit($id_toko)
    {
        try {
            $data['toko'] = Toko::findOrFail($id_toko);
            $data['karyawan'] = Karyawan::lists('nama_karyawan', 'id_karyawan');

            return view('modules.toko.edit', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id_toko
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_toko)
    {
        // Copy base rules.
        $rulesExtra = $this->rules;
        // Add extra rule, must be unique except for the currently edited.
        $rulesExtra['id_toko'] .= ',' . $id_toko . ',id_toko';
        // Validate request.
        $this->validate($request, $rulesExtra);

        try {
            $toko = Toko::findOrFail($id_toko);

            $toko->update($request->all());

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
     * @param  string  $id_toko
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_toko)
    {
        try {
            $toko = Toko::findOrFail($id_toko);

            $toko->delete();

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
    public function getToko()
    {
        $inventoris = Toko::select([
                                    'master_toko.id_toko',
                                    'master_toko.nama_toko',
                                ])
                                ->get();

        return $inventoris;
    }

}
