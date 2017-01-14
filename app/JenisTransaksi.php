<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisTransaksi extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jenis_transaksi';

    /**
     * Override default primary key used by laravel ('id')
     *
     * @var string
     */
    protected $primaryKey = 'id_jenis_transaksi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis_transaksi',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Indicates if table primary key auto increments.
     *
     * @var boolean
     */
    public $incrementing = false;
}
