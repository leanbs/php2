<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksi extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transaksi';

    /**
     * Override default primary key used by laravel ('id')
     *
     * @var string
     */
    protected $primaryKey = 'id_transaksi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_jenis_transaksi',
        'nama_pelanggan',
        'alamat',
        'nomor_telp',
        'tanggal_transaksi',
        'id_karyawan',
        'status_bayar',
        'status_kirim',
        'id_transaksi',
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
     * A Transaksi belongs to a jenis_transaksi.
     *
     * @return mixed
     */
    public function jenis_transaksi()
    {
        return $this->belongsTo('App\JenisTransaksi', 'id_jenis_transaksi', 'id_jenis_transaksi');
    }	

    /**
     * A Transaksi belongs to a karyawan.
     *
     * @return mixed
     */
    public function karyawan()
    {
        return $this->belongsTo('App\Karyawan', 'id_karyawan', 'id_karyawan');
    }

    /**
     * A Transaksi has many to a detil_transaksi.
     *
     * @return mixed
     */
    public function detil_transaksi()
    {
        return $this->hasMany('App\DetilTransaksi', 'id_transaksi', 'id_transaksi');
    }

    /**
     * A Transaksi has many tipe_brg.
     *
     * @return mixed
     */
    public function inventori()
    {
        return $this->hasMany('App\DetilTransaksi', 'tipe_barang', 'tipe_brg');
    }

    /**
     * Get candidate birth date as a carbon (date helper) instance.
     *
     * @param  string  $date  Raw date from database
     * @return Carbon\Carbon
     */
    public function getTanggalTransaksiAttribute($date)
    {       
        if (is_null($this->attributes['tanggal_transaksi'])) return null;

        return Carbon::parse($date)->format('d F Y');
    }

    /**
     * Set birth date attribute for current candidate (parsed using Carbon).
     * Format in database : Y-m-d, input format from view : d/m/Y
     *
     * @param  string  $date  Date to be parsed
     * @return void
     */
    public function setTanggalTransaksiAttribute($date)
    {
        $this->attributes['tanggal_transaksi'] = Carbon::createFromFormat('d/m/Y', $date);
    }
}
