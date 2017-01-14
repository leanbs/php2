<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisKelamin extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jns_kelamin';

    /**
     * Override default primary key used by laravel ('id')
     *
     * @var string
     */
    protected $primaryKey = 'id_jns_kelamin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jns_kelamin',
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

    /**
     * A jns_kelamin belongs to a karyawan.
     *
     * @return mixed
     */
    public function toko()
    {
        return $this->belongsTo('App\Karyawan', 'id_jns_kelamin', 'id_jns_kelamin');
    }
}
