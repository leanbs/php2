<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'serial';

    /**
     * Override default primary key used by laravel ('id')
     *
     * @var string
     */
    protected $primaryKey = 'id_serial';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipe_brg',
        'serial',
        'jumlah',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;


    /**
     * A Serial belongs to a Inventory.
     *
     * @return mixed
     */
    public function merk()
    {
        return $this->belongsTo('App\Inventori', 'tipe_brg', 'tipe_brg');
    }
}
