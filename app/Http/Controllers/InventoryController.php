<?php

namespace App\Http\Controllers;

use Log;
use Datatables;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests;
use App\Http\Requests\InventoryRequest;
use App\Inventori;
use App\Kategori;
use App\Merk;
use App\Serial;

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
                                ]);

        return Datatables::of($inventoris)
            ->editColumn('tipe_brg', function ($inventori) {
                return
                    '<a id="showSeri-'. $inventori['tipe_brg'] .'"
                        style="color: blue; text-decoration: none; cursor: pointer;"
                        title="Klik melihat list serial kode">
                        '. $inventori['tipe_brg'] .'
                    </a>
                    <script type="text/javascript">
                        $(function(){
                            $.ajaxSetup ({
                                cache: false
                            });
                            var id = "'. $inventori['tipe_brg'] .'";                               
                            var loadUrl = "inventori/serial/"+id;
                            $("#showSeri-"+id).click(function(){
                                $("#modal-body-showListSerial").load(loadUrl, function(result){
                                    $("#modalShowListSerial").modal({show:true});
                                });
                            });
                        });
                    </script>';
            })
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

        $tipe = Inventori::get();

        // $moo = '<option value="">--</option>';

        // foreach ($tipe as $value) 
        // {
        //     $moo .= '<option value="$value->tipe_brg">$value->tipe_brg</option>';
        // }
       

        return view('modules.inventori.create', $data);
                // ->with('tipe', $moo);
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

        $inventori = Inventori::create([
                'tipe_brg'         => $tipe_brg,
                'id_kategori'      => $id_kategori,
                'id_merk'          => $id_merk,
                'harga_barang'     => $harga_barang,
            ]);

        return response()->json([
            'success' => trans('action.success.add'),
            // 'success' => $harga_barang,
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

    public function showSerial($id)
    {
        return view('modal.serial.show.formShow')
            ->with('id', $id);
    }

    public function showTableSerial($id)
    {
        $serial = Serial::join('inventori', 'serial.tipe_brg', '=', 'inventori.tipe_brg')
                        ->where('serial.tipe_brg', '=', $id)
                        ->select([
                            'serial.id_serial as id_serial',
                            'serial.serial as serial',
                            'serial.jumlah as jumlah'
                        ])->get();

        return Datatables::of($serial)
            ->editColumn('serial', function ($serials) {
                return
                    '<input type="text" id="serial-'. $serials->id_serial .'" class="form-control" value="'. $serials->serial .'">';
            })
            ->editColumn('jumlah', function ($serials) {
                return
                    '<input type="text" id="jumlah-'. $serials->id_serial .'" class="form-control" value="'. $serials->jumlah .'">';
            })
            ->addColumn('Action', function ($serials) {
                return
                    '<a id="editSerial-'. $serials->id_serial .'"
                        data-toggle="modal" data-target="#deleteModalHistoriMasuk" 
                        style="color: blue; text-decoration: none; cursor: pointer;"
                        title="Klik untuk mengubah produk terjual ini"
                        onclick="ubahSerial(this)">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                    &nbsp;&nbsp;
                    <a id="deleteSerial-'. $serials->id_serial .'" 
                        data-toggle="modal" data-target="#stokProdukEditModal" 
                        style="color: red; text-decoration: none; cursor: pointer;"
                        title="Klik untuk menghapus produk terjual ini"
                        onclick="hapusSerial(this)">
                        <i class="fa fa-trash-o"></i>
                    </a>';
            })
            ->make(true);
    }

    protected function validatorAddSerial(array $data)
    {
        return Validator::make($data, [
            'serial'                => 'required',
            'jumlah'                => 'required|numeric',
        ]);      
    }

    public function addSerial(Request $request)
    {
        $validator = $this->validatorAddSerial($request->all());
        if ($validator->fails()) 
        {
            $this->throwValidationException($request, $validator);
        }  

        $tipe = $request->input('id');
        $serial = $request->input('serial');
        $jumlah = $request->input('jumlah');

        $serial = Serial::create([
                'tipe_brg'         => $tipe,
                'serial'           => $serial,
                'jumlah'           => $jumlah,            
        ]);

        return response()->json([
            'success' => trans('action.success.add'),
            // 'success' => $harga_barang,
        ]);
    }



    public function editSerial(Request $request)
    {
        // Copy base rules.
        $validator = $this->validatorAddSerial($request->all());
        if ($validator->fails()) 
        {
            $this->throwValidationException($request, $validator);
        }  

        $id = $request->id;
        $jumlah = $request->jumlah;
        $serial = $request->serial;

            $serials = Serial::findOrFail($id);

            $serials->update([
                    'serial'           => $serial,
                    'jumlah'           => $jumlah,
                ]);

            return 'Update success.';
    }

    public function deleteSerial(Request $request)
    {   

        $id = $request->id;

            $serials = Serial::findOrFail($id);

            $serials->delete();

            return 'delete success.';
    }
}
