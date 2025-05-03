<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Output
 *
 * @property $id
 * @property $product_id
 * @property $type
 * @property $quantity
 * @property $notes
 * @property $created_at
 * @property $updated_at
 *
 * @property Product $product
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Output extends Model
{
    
    static $rules = [
		'product_id' => 'required',
		'type' => 'required',
		'quantity' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id','type','quantity','notes'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
    

}
