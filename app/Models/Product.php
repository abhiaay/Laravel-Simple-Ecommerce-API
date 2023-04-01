<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public $uuids = true;

    #################
    #   RELATIONS   #
    #################
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
