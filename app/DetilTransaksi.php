<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DetilTransaksi extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'detil_transaksi';

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
        'id_transaksi',
        'tipe_barang',
        'jumlah',
        'harga',
        'keterangan',
        'harga_modal',
        'harga_total',
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
     * A DetilTransaksi has many inventori.
     *
     * @return mixed
     */
    public function inventori()
    {
        return $this->hasMany('App\Inventori', 'tipe_brg', 'tipe_barang');
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
