<?php

namespace App\Http\Controllers;

use Log;
use Datatables;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\JenisTransaksi;

class JenisTransaksiController extends Controller
{
    /**
     * Validation rule for account creation.
     *
     * @var array
     */
    protected $rules = [
        'id_jenis_transaksi'   => 'unique',
        'jenis_transaksi' => 'required|max:20',
    ];

    /**
     * Constructor.
     */
    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenistransaksis = JenisTransaksi::select('*');

        return Datatables::of($jenistransaksis)
            ->addColumn('Action', function ($jenistransaksis) {
                $urlEdit = url('/jenistransaksi/' . $jenistransaksis['id_jenis_transaksi'] . '/edit');
                $urlDelete = url('/jenistransaksi/' . $jenistransaksis['id_jenis_transaksi']);

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
        $data['jenistransaksi'] = new JenisTransaksi;

        return view('modules.jenistransaksi.create', $data);
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

        $jenistransaksis = JenisTransaksi::create($request->all());

        return response()->json([
            'success' => trans('action.success.add'),
        ]);
    }

        /**
     * Display the specified resource.
     *
     * @param  string  $id_jenis_transaksi
     * @return \Illuminate\Http\Response
     */
    public function show($id_jenis_transaksi)
    {
        try {
            $data['jenistransaksi'] = JenisTransaksi::findOrFail($id_jenis_transaksi);

            return view('modules.jenistransaksi.delete', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id_jenis_transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit($id_jenis_transaksi)
    {
        try {
            $data['jenistransaksi'] = JenisTransaksi::findOrFail($id_jenis_transaksi);

            return view('modules.jenistransaksi.edit', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id_jenis_transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_jenis_transaksi)
    {
        // Copy base rules.
        $rulesExtra = $this->rules;
        // Add extra rule, must be unique except for the currently edited.
        $rulesExtra['id_jenis_transaksi'] .= ',' . $id_jenis_transaksi . ',id_jenis_transaksi';
        // Validate request.
        $this->validate($request, $rulesExtra);

        try {
            $jenistransaksis = JenisTransaksi::findOrFail($id_jenis_transaksi);

            $jenistransaksis->update($request->all());

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
     * @param  string  $id_jenis_transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_jenis_transaksi)
    {
        try {
            $jenistransaksis = JenisTransaksi::findOrFail($id_jenis_transaksi);

            $jenistransaksis->delete();

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
    public function getJenisTransaksi()
    {
        $inventoris = JenisTransaksi::select([
                                    'jenis_transaksi.id_jenis_transaksi',
                                    'jenis_transaksi.jenis_transaksi',
                                ])
                                ->get();

        return $inventoris;
    }
}
