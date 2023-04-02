<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public $uuids = true;

    protected $guarded = false;

    protected $casts = [
        'created_at' => 'datetime: d-m-Y H:i:s',
        'updated_at' => 'datetime: d-m-Y H:i:s',
    ];

    #################
    #   RELATIONS   #
    #################
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
