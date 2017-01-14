<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\DetilTransaksiRequest;
use App\DetilTransaksi;

class DetilTransaksiController extends Controller
{
	/**
     * Validation rule for account creation.
     *
     * @var array
     */
    protected $rules = [
        'id_transaksi'   => 'required',
        
    ];

    /**
     * Constructor.
     */
    public function __construct()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DetilTransaksiRequest $request)
    {
        // $this->validate($request, $this->rules);

        $detiltransaksis = DetilTransaksi::create($request->all());

        return response()->json([
            'success' => trans('action.success.add'),
        ]);
    }
}
