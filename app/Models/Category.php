<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;
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
}
