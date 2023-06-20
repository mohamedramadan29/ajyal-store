<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = [
        'id', 'cookie_id', 'user_id', 'product_id', 'quantity', 'options'
    ];

    /**
     * Events (Observed)
     * creating , created , updating , updated , deleting , deleted,
     * restoring , restored , retrived
     */
    // دي معناها وانت بتنشا الكارت يامعلم بدل ما تروح كل شي شوية تضيفها من الكونرولار لا ضيفها معاك مباشر من هنا 

    public static function booted()
    {
        static::creating(function (Cart $cart ) {
            $cart->id = Str::uuid();
        });
    }

    // make relations

    public function user(){
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'anymous',
        ]);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
