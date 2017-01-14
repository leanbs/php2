<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pengaturan';

    /**
     * Override default primary key used by laravel ('id')
     *
     * @var string
     */
    // protected $primaryKey = '';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_pengaturan',
        'nilai_pengaturan',
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
