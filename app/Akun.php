<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Override default primary key used by laravel ('id')
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'username',
        'password',
        'role',
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
    public $incrementing = true;
}
