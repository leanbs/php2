<?php

namespace App\Http\Controllers;

use Log;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests;
use App\Http\Requests\InventoryRequest;
use App\Inventori;
use App\Kategori;
use App\Merk;

class InventoryController extends Controller
{
    /**
     * Validation rule for account creation.
     *
     * @var array
     */
    protected $rules = [
        'tipe_brg'   => 'required|max:10|unique:inventori,tipe_brg',
        'harga_barang' => 'required|max:50',
    ];

    /**
     * Constructor.
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display page to manage current resource.
     *
     * @return Response
     */
    public function manage()
    {
        return view('modules.inventori.inventori');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventoris = Inventori::leftJoin('master_merk',
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
                                ]);

        return Datatables::of($inventoris)
            ->addColumn('Action', function ($inventori) {
                $urlEdit = url('/inventori/' . $inventori['tipe_brg'] . '/edit');
                $urlDelete = url('/inventori/' . $inventori['tipe_brg']);

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
            ->editColumn('harga_barang', function ($inventori) {
                return number_format($inventori->harga_barang, 2, ",", ".");
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
        $data['inventori'] = new Inventori;

        $data['kategori'] = Kategori::lists('kategori', 'id_kategori');
        $data['merk'] = Merk::lists('merk', 'id_merk');

        return view('modules.inventori.create', $data);
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
        $tipe_brg = $request->input('tipe_brg');
        $harga_barang = floatval(str_replace(".","", $request->input('harga_barang')));
        $id_merk = $request->input('id_merk');
        $id_kategori = $request->input('id_kategori');
        $jumlah = $request->input('jumlah');

        $inventori = Inventori::create([
                'tipe_brg'         => $tipe_brg,
                'id_kategori'      => $id_kategori,
                'id_merk'          => $id_merk,
                'harga_barang'     => $harga_barang,
                'jumlah'           => $jumlah,
            ]);

        return response()->json([
            // 'success' => trans('action.success.add'),
            'success' => $harga_barang,
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
            $inventori = Inventori::findOrFail($tipe_brg);
            $data['inventori'] = $inventori;
            $data['kategori'] = Kategori::lists('kategori', 'id_kategori');
            $data['merk'] = Merk::lists('merk', 'id_merk');

            return view('modules.inventori.delete', $data);
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
            $inventori = Inventori::findOrFail($tipe_brg);
            $data['inventori'] = $inventori;
            $data['kategori'] = Kategori::lists('kategori', 'id_kategori');
            $data['merk'] = Merk::lists('merk', 'id_merk');

            return view('modules.inventori.edit', $data);
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
    public function update(InventoryRequest $request, $tipe_brg)
    {
        // Copy base rules.
        $rulesExtra = $this->rules;
        // Add extra rule, must be unique except for the currently edited.
        $rulesExtra['tipe_brg'] .= ',' . $tipe_brg . ',tipe_brg';
        // Validate request.
        $this->validate($request, $rulesExtra);

        $tipe_brg = $request->input('tipe_brg');
        $harga_barang = floatval(str_replace(".","", $request->input('harga_barang')));
        $id_merk = $request->input('id_merk');
        $id_kategori = $request->input('id_kategori');
        $jumlah = $request->input('jumlah');

        try {
            $inventori = Inventori::findOrFail($tipe_brg);

            $inventori->update([
                    'tipe_brg'         => $tipe_brg,
                    'id_kategori'      => $id_kategori,
                    'id_merk'          => $id_merk,
                    'harga_barang'     => $harga_barang,
                    'jumlah'           => $jumlah,
                ]);

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
    public function destroy($tipe_brg)
    {
        try {
            $inventori = Inventori::findOrFail($tipe_brg);

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInventori()
    {
        $inventoris = Inventori::leftJoin('master_merk',
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

        return $inventoris;
    }

}
