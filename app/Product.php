<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @package App
 *
 * @param integer $id The ID of the product
 * @param string $name Name of the product
 * @param float $price The price of the product
 * @param timestamp $created_at When the product was created
 * @param timestamp $updated_at The last time the product was updated
 */
class Product extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
