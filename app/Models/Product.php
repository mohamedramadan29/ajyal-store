<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded = ['id'];


    // to make global scope for product (show products for every user have store )

    protected static function booted()
    {
        static::addGlobalScope('store',function (Builder $builder){
            $user = Auth::user();
            if($user->store_id){
                $builder->where('store_id','=',$user->store_id);
            }

        });
    }

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }
    public function Store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }


}
