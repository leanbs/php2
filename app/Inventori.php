<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventori extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inventori';

    /**
     * Override default primary key used by laravel ('id')
     *
     * @var string
     */
    protected $primaryKey = 'tipe_brg';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipe_brg',
        'id_kategori',
        'id_merk',
        'harga_barang',
        'jumlah',
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
     * A Inventory belongs to a merk.
     *
     * @return mixed
     */
    public function merk()
    {
        return $this->belongsTo('App\Merk', 'id_merk', 'id_merk');
    }

    /**
     * A Inventory belongs to a detil transaksi.
     *
     * @return mixed
     */
    public function detil_transaksi()
    {
        return $this->belongsTo('App\DetilTransaksi', 'tipe_barang', 'tipe_brg');
    }

    /**
     * A Inventory belongs to a kategori.
     *
     * @return mixed
     */
    public function kategori()
    {
        return $this->belongsTo('App\Kategori', 'id_kategori', 'id_kategori');
    }

}
