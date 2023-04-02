<?php

namespace App\Models;

use Illuminate\Support\Str;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    ################
    #   ACCESSOR   #
    ################
    public function getThumbnailUrlAttribute(): string
    {
        if(Str::of($this->thumbnail)->contains(['http://', 'https://'])) {
            return $this->thumbnail;
        }
        return Storage::disk('public')->url($this->thumbnail);
    }

    public function getImagesUrlAttribute(): array
    {
        $images = [];
        foreach($this->images as $image) {
            if(Str::of($image)->contains(['http://', 'https://'])) {
                $images[] = $image;
                continue;
            }
            $images[] = Storage::disk('public')->url($image);
        }
        return $images;
    }
}
