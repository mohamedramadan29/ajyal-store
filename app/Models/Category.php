<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory , SoftDeletes;
    // white list
    protected $fillable = ['name','parent_id','slug','description','image','status'];
    // black list
    protected $guarded = ['id'];
    public static function rules($id = 0){
        return[
            'name'=>[
                'required',
                'string',
                'min:3',
                'max:255',
             //   "unique:categories,name,$id",
              /*  Rule::unique('categories','name')->ignore($id),
                 function($attribute,$value,$fails){
            if($value == 'laravel'){
                $fails('This Value Is Not Avaialble');
            }

            },*/
                'filter:laravel,php,sql,html,css,flutter' // this is customer validation rules
                ],

            'parent_id'=>[
                'nullable','int','exists:categories,id'
            ],
            'image'=>[
                'image','max:1048576','dimensions:min_width:100,max_width:100'
            ],
            'status'=>[
                'in:active,archieve'
            ],
        ];
    }

    // start use local scope

    public function scopeStatus(Builder $builder){
        $builder->where('status' ,'=' , 'active');
    }
    public function scopeFilter(Builder $builder,$filters){
        if($filters['name'] ?? false){
            $builder->where('name','LIKE',"%{$filters['name']}%");
        }
        if($filters['status'] ?? false){
            $builder->where('status','=',$filters['status']);
        }
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // hasmany relationship between category and product

    public function Products(){
        return $this->hasMany(Product::class,'category_id','id');
    }


}
