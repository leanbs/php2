<?php

namespace App\Http\Controllers;

use Log;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests;
use App\Kategori;

class KategoriController extends Controller
{
    /**
     * Validation rule for account creation.
     *
     * @var array
     */
    protected $rules = [
        'id_kategori'   => 'unique',
        'kategori' => 'required|max:20',
    ];

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris = Kategori::select('*');

        return Datatables::of($kategoris)
            ->addColumn('Action', function ($kategori) {
                $urlEdit = url('/kategori/' . $kategori['id_kategori'] . '/edit');
                $urlDelete = url('/kategori/' . $kategori['id_kategori']);

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
        $data['kategori'] = new Kategori;

        return view('modules.kategori.create', $data);
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

        $kategori = Kategori::create($request->all());

        return response()->json([
            'success' => trans('action.success.add'),
        ]);
    }

        /**
     * Display the specified resource.
     *
     * @param  string  $id_kategori
     * @return \Illuminate\Http\Response
     */
    public function show($id_kategori)
    {
        try {
            $data['kategori'] = Kategori::findOrFail($id_kategori);

            return view('modules.kategori.delete', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id_kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id_kategori)
    {
        try {
            $data['kategori'] = Kategori::findOrFail($id_kategori);

            return view('modules.kategori.edit', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id_kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kategori)
    {
        // Copy base rules.
        $rulesExtra = $this->rules;
        // Add extra rule, must be unique except for the currently edited.
        $rulesExtra['id_kategori'] .= ',' . $id_kategori . ',id_kategori';
        // Validate request.
        $this->validate($request, $rulesExtra);

        try {
            $kategori = Kategori::findOrFail($id_kategori);

            $kategori->update($request->all());

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
     * @param  string  $id_kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kategori)
    {
        try {
            $kategori = Kategori::findOrFail($id_kategori);

            $kategori->delete();

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
