<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'created_at' => 'datetime: d-m-Y H:i:s',
        'updated_at' => 'datetime: d-m-Y H:i:s'
    ];
    
    #################
    #   RELATIONS   #
    #################
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
