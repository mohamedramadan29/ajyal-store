<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // white list
    protected $fillable = ['name','parent_id','slug','description','image','status'];
    // black list
    protected $guarded = ['id'];
}
