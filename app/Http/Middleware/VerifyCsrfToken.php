<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'akun',
        'transaksi',
        'detiltransaksi',
        'api/updateInventory/stok/{stok}/tipe_brg/{tipe_brg}',
        'manage/inventori/serial/edit',
        'manage/inventori/serial/delete'
    ];
}
