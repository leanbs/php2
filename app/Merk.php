<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'master_merk';

    /**
     * Override default primary key used by laravel ('id')
     *
     * @var string
     */
    protected $primaryKey = 'id_merk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merk',
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
     * A merk can have many inventory.
     *
     * @return mixed
     */
    public function inventori()
    {
        return $this->hasMany('App\Inventori', 'id_merk', 'id_merk');
    }
}
