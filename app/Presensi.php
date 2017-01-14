<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'presensi_karyawan';

    /**
     * Override default primary key used by laravel ('id')
     *
     * @var string
     */
    protected $primaryKey = 'id_presensi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_presensi',
        'id_karyawan',
        'tgl_presensi',
        'jam_hadir',
        'status_hadir',
        'keterangan',
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
     * A presensi belongs to a karyawan.
     *
     * @return mixed
     */
    public function karyawan()
    {
        return $this->belongsTo('App\Karyawan', 'id_karyawan', 'id_karyawan');
    }

    /**
     * Get tgl presensi as a carbon (date helper) instance.
     *
     * @param  string  $date  Raw date from database
     * @return Carbon\Carbon
     */
    public function getTglPresensiAttribute($date)
    {
        if(!isset($date)) return null;
        
        if (is_null($this->attributes['tgl_presensi'])) return null;

        return Carbon::parse($date)->format('d F Y');
    }

    /**
     * Set tgl presensi attribute for current candidate (parsed using Carbon).
     * Format in database : Y-m-d, input format from view : d/m/Y
     *
     * @param  string  $date  Date to be parsed
     * @return void
     */
    public function setTglPresensiAttribute($date)
    {
        $this->attributes['tgl_presensi'] = Carbon::createFromFormat('d F Y', $date);
    }
}
