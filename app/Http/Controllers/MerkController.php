<?php

namespace App\Http\Controllers;

use Log;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests;
use App\Merk;

class MerkController extends Controller
{
    /**
     * Validation rule for account creation.
     *
     * @var array
     */
    protected $rules = [
        'id_merk' => 'unique',
        'merk' => 'required|max:20',
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
        $merks = Merk::select('*');

        return Datatables::of($merks)
            ->addColumn('Action', function ($merk) {
                $urlEdit = url('/merk/' . $merk['id_merk'] . '/edit');
                $urlDelete = url('/merk/' . $merk['id_merk']);

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
        $data['merk'] = new Merk;

        return view('modules.merk.create', $data);
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

        $kategori = Merk::create($request->all());

        return response()->json([
            'success' => trans('action.success.add'),
        ]);
    }

        /**
     * Display the specified resource.
     *
     * @param  string  $id_merk
     * @return \Illuminate\Http\Response
     */
    public function show($id_merk)
    {
        try {
            $data['merk'] = Merk::findOrFail($id_merk);

            return view('modules.merk.delete', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id_merk
     * @return \Illuminate\Http\Response
     */
    public function edit($id_merk)
    {
        try {
            $data['merk'] = Merk::findOrFail($id_merk);

            return view('modules.merk.edit', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id_merk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_merk)
    {
        // Copy base rules.
        $rulesExtra = $this->rules;
        // Add extra rule, must be unique except for the currently edited.
        $rulesExtra['id_merk'] .= ',' . $id_merk . ',id_merk';
        // Validate request.
        $this->validate($request, $rulesExtra);

        try {
            $merk = Merk::findOrFail($id_merk);

            $merk->update($request->all());

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
     * @param  string  $id_merk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_merk)
    {
        try {
            $merk = Merk::findOrFail($id_merk);

            $merk->delete();

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
