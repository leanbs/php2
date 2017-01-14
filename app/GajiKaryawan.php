<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GajiKaryawan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gaji_karyawan';

    /**
     * Override default primary key used by laravel ('id')
     *
     * @var string
     */
    protected $primaryKey = 'id_karyawan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_karyawan',
        'bonus',
        'gaji',
        'denda',
        'uang_makan',
        'jumlah_gaji',
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
     * A Gaji belongs to a karyawan.
     *
     * @return mixed
     */
    public function karyawan()
    {
        return $this->belongsTo('App\Karyawan', 'id_karyawan', 'id_karyawan');
    }

    /**
     * Get candidate birth date as a carbon (date helper) instance.
     *
     * @param  string  $date  Raw date from database
     * @return Carbon\Carbon
     */  
}
