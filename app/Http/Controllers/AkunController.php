<?php

namespace App\Http\Controllers;

use Log;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests;
use App\Akun;

class AkunController extends Controller
{
    /**
     * Validation rule for account creation.
     *
     * @var array
     */
    protected $rules = [
        'id'   => 'required|max:10|unique:users,id',
        'name' => 'required|max:50',
        'username' => 'required|max:50',
        'password' => 'required|max:50',
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
        return view('modules.akun.akun');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akuns = Akun::select('*');

        return Datatables::of($akuns)
            ->addColumn('Action', function ($akun) {
                $urlEdit = url('/akun/' . $akun['id'] . '/edit');
                $urlDelete = url('/akun/' . $akun['id']);

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
        $data['akun'] = new Akun;

        return view('modules.akun.create', $data);
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

        $akun = Akun::create($request->all());

        return response()->json([
            'success' => trans('action.success.add'),
        ]);
    }

        /**
     * Display the specified resource.
     *
     * @param  string  $idakun
     * @return \Illuminate\Http\Response
     */
    public function show($idakun)
    {
        try {
            $data['akun'] = Akun::findOrFail($idakun);

            return view('modules.akun.delete', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $idakun
     * @return \Illuminate\Http\Response
     */
    public function edit($idakun)
    {
        try {
            $data['akun'] = Akun::findOrFail($idakun);

            return view('modules.akun.edit', $data);
        } catch (ModelNotFoundException $e) {
            $data['error'] = trans('modal.fail.missing');

            return view('partials.modal.error', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $idakun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Copy base rules.
        $rulesExtra = $this->rules;
        // Add extra rule, must be unique except for the currently edited.
        $rulesExtra['id'] .= ',' . $id . ',id';
        // Validate request.
        $this->validate($request, $rulesExtra);

        try {
            $akun = Akun::findOrFail($id);

            $akun->update($request->all());

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
     * @param  string  $idakun
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $akun = Akun::findOrFail($id);

            $akun->delete();

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
