<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        "name",
        "category",
        "price",
        "discount_price",
        "description",
        "contact",
        "image",
        "status"
    ];

    public function imageUrl():Attribute{
        return Attribute::get(
            function(){
                return asset($this->image);
            }
        );
    }
}
