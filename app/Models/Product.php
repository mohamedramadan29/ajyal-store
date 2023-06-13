<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];


    // to make global scope for product (show products for every user have store )

    protected static function booted()
    {
        static::addGlobalScope('store', function (Builder $builder) {
            $user = Auth::user();
            if ($user && $user->store_id) {
                $builder->where('store_id', '=', $user->store_id);
            }
        });
    }

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function Store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags()
    {
        $this->belongsToMany(
            Tag::class, // Related Model
            'product_tag', // Pivot Table Name
            "product_id", // Fk in pivot Table for the current Model
            "tag_id", // Fk in Pivot Table Fot The Related Model
            "id", // Pk for the current Model
            "id" // Pk for the Related Model
        );
    }

    // define local scope active to get active product only
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }
    // Make Accessors // ممكن تعمل اي شي هنا وترجعه عادى كانة عمود في الداتا بيز 
    /**
     * والتعريف بتاعه دائما بيكون كدا 
     * get وهنا الاسم Attribute (getImgaeUrlAttribute)
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return "default image here ";
        }
        if (Str::startsWith($this->image, ['https://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    // to get sale value

    public function getSalePercentAttribute(){
        if(! $this->compare_price){
            return ;
        }
        return number_format( 100 - (100 * $this->price / $this->compare_price),1);
    }
}
