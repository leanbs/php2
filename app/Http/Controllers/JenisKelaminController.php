<?php

namespace App\Http\Controllers;

use Log;
use Datatables;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\JenisKelamin;

class JenisKelaminController extends Controller
{
    /**
     * Validation rule for account creation.
     *
     * @var array
     */
    protected $rules = [
        'id_jns_kelamin'   => 'unique',
        'jns_kelamin' => 'required|max:20',
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
        $jeniskelamins = JenisKelamin::select('*');

        return Datatables::of($jeniskelamins)
            ->addColumn('Action', function ($jeniskelamins) {
                $urlEdit = url('/jeniskelamin/' . $jeniskelamins['id_jns_kelamin'] . '/edit');
                $urlDelete = url('/jeniskelamin/' . $jeniskelamins['id_jns_kelamin']);

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
        $data['jeniskelamin'] = new JenisKelamin;

        return view('modules.jeniskelamin.create', $data);
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

        $jeniskelamins = JenisKelamin::create($request->all());

        return response()->json([
            'success' => trans('action.success.add'),
        ]);
    }

        /**
     * Display the specified resource.
     *
     * @param  string  $id_jns_kelamin
     * @return \Illuminate\Http\Response
     */
    public function show($id_jns_kelamin)
    {
        try {
            $data['jeniskelamin'] = JenisKelamin::findOrFail($id_jns_kelamin);

            return view('modules.jeniskelamin.delete', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id_jns_kelamin
     * @return \Illuminate\Http\Response
     */
    public function edit($id_jns_kelamin)
    {
        try {
            $data['jeniskelamin'] = JenisKelamin::findOrFail($id_jns_kelamin);

            return view('modules.jeniskelamin.edit', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id_jns_kelamin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_jns_kelamin)
    {
        // Copy base rules.
        $rulesExtra = $this->rules;
        // Add extra rule, must be unique except for the currently edited.
        $rulesExtra['id_jns_kelamin'] .= ',' . $id_jns_kelamin . ',id_jns_kelamin';
        // Validate request.
        $this->validate($request, $rulesExtra);

        try {
            $jeniskelamins = JenisKelamin::findOrFail($id_jns_kelamin);

            $jeniskelamins->update($request->all());

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
     * @param  string  $id_jns_kelamin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_jns_kelamin)
    {
        try {
            $jeniskelamins = JenisKelamin::findOrFail($id_jns_kelamin);

            $jeniskelamins->delete();

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
