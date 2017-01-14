<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Karyawan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'karyawan';

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
        'id_toko',
        'id_jns_kelamin',
        'nama_karyawan',
        'tempat_lhr',
        'tgl_lhr',
        'alamat',
        'nomor_telp',
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
     * A Karyawan belongs to a toko.
     *
     * @return mixed
     */
    public function toko()
    {
        return $this->belongsTo('App\Toko', 'id_toko', 'id_toko');
    }

    /**
     * Get candidate birth date as a carbon (date helper) instance.
     *
     * @param  string  $date  Raw date from database
     * @return Carbon\Carbon
     */
    public function getTglLhrAttribute($date)
    {
        if(! isset($date)) return null;
        
        if (is_null($this->attributes['tgl_lhr'])) return null;

        return Carbon::parse($date)->format('d F Y');
    }

    /**
     * Set birth date attribute for current candidate (parsed using Carbon).
     * Format in database : Y-m-d, input format from view : d/m/Y
     *
     * @param  string  $date  Date to be parsed
     * @return void
     */
    public function setTglLhrAttribute($date)
    {
        $this->attributes['tgl_lhr'] = Carbon::createFromFormat('d F Y', $date);
    }
}
