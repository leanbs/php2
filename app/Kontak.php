<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'kontak';

    /**
     * Override default primary key used by laravel ('id')
     *
     * @var string
     */
    protected $primaryKey = 'id_kontak';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_perusahaan',
        'nama',
        'alamat',
        'no_telp',
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
