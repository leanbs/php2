<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hutang_karyawan';

    /**
     * Override default primary key used by laravel ('id')
     *
     * @var string
     */
    protected $primaryKey = 'id_hutang';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_hutang',
        'id_karyawan',
        'hutang',
        'jangka_waktu',
        'keterangan',
        'status',
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
     * A Hutang belongs to a karyawan.
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
    public function getJangkaWaktuAttribute($date)
    {
        if(! isset($date)) return null;
        
        if (is_null($this->attributes['jangka_waktu'])) return null;

        return Carbon::parse($date)->format('d F Y');
    }

    /**
     * Set birth date attribute for current candidate (parsed using Carbon).
     * Format in database : Y-m-d, input format from view : d/m/Y
     *
     * @param  string  $date  Date to be parsed
     * @return void
     */
    public function setJangkaWaktuAttribute($date)
    {
        $this->attributes['jangka_waktu'] = Carbon::createFromFormat('d F Y', $date);
    }

}
