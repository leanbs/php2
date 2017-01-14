<?php

namespace App\Http\Controllers;

use Datatables;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Kontak;

class KontakController extends Controller
{
    /**
     * Validation rule for account creation.
     *
     * @var array
     */
    protected $rules = [
        'id_kontak'   => 'unique:kontak,id_kontak',
        'nama' => 'required|max:50',
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
        return view('modules.kontak.kontak');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kontaks = Kontak::select('*');

        return Datatables::of($kontaks)
            ->addColumn('Action', function ($kontak) {
                $urlEdit = url('/kontak/' . $kontak['id_kontak'] . '/edit');
                $urlDelete = url('/kontak/' . $kontak['id_kontak']);

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
        $data['kontak'] = new Kontak;

        return view('modules.kontak.create', $data);
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

        $kontak = Kontak::create($request->all());

        return response()->json([
            'success' => trans('action.success.add'),
        ]);
    }

        /**
     * Display the specified resource.
     *
     * @param  string  $id_kontak
     * @return \Illuminate\Http\Response
     */
    public function show($id_kontak)
    {
        try {
            $data['kontak'] = Kontak::findOrFail($id_kontak);
            
            return view('modules.kontak.delete', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id_kontak
     * @return \Illuminate\Http\Response
     */
    public function edit($id_kontak)
    {
        try {
            $data['kontak'] = Kontak::findOrFail($id_kontak);

            return view('modules.kontak.edit', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id_kontak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kontak)
    {
        // Copy base rules.
        $rulesExtra = $this->rules;
        // Add extra rule, must be unique except for the currently edited.
        $rulesExtra['id_kontak'] .= ',' . $id_kontak . ',id_kontak';
        // Validate request.
        $this->validate($request, $rulesExtra);

        try {
            $kontak = Kontak::findOrFail($id_kontak);

            $kontak->update($request->all());

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
     * @param  string  $id_kontak
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kontak)
    {
        try {
            $kontak = Kontak::findOrFail($id_kontak);

            $kontak->delete();

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
