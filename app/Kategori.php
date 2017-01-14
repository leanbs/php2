<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'master_kategori';

    /**
     * Override default primary key used by laravel ('id')
     *
     * @var string
     */
    protected $primaryKey = 'id_kategori';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kategori',
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
     * A kategori can have many inventory.
     *
     * @return mixed
     */
    public function inventori()
    {
        return $this->hasMany('App\Inventori', 'id_kategori', 'id_kategori');
    }
}
