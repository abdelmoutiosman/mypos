<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'category_id', 'purchase_price', 'image', 'sale_price', 'stock',
    ];
    protected $appends= ['image_path','profit_percent'];
    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/'.$this->image);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function getProfitPercentAttribute()
    {
        $profit=$this->sale_price - $this->purchase_price;
        $profit_percent=$profit * 100 / $this->purchase_price;
        return number_format($profit_percent,2);
    }
}
