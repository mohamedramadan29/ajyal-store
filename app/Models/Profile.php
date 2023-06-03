<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id','first_name','last_name','profile_image','phone','birthdate','gender','address','city','state',
        'postal_code','country','local'
    ];
    protected $primaryKey = 'user_id';
    public function user(){
        $this->belongsTo(User::class,'user_id','id');
    }
}
