<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'master_toko';

    /**
     * Override default primary key used by laravel ('id')
     *
     * @var string
     */
    protected $primaryKey = 'id_toko';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_toko',
        'nama_toko',
        'alamat',
        'supervisor',
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
     * A Toko belongs to a karyawan.
     *
     * @return mixed
     */
    public function karyawan()
    {
        return $this->belongsTo('App\Karyawan', 'id_karyawan', 'supervisor');
    }

}
