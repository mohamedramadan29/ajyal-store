<?php 
namespace App\Repositories\cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartModelRepository implements RepositoriesCart{
    public function get(): Collection
    {
        return Cart::where('cookie_id','=',$this->getcookieid())->get();
    }
    public function add(Product $product, $quantity = 1)
    {
        return Cart::create([
            'cookie_id'=>$this->getcookieid(),
            'user_id'=>Auth::id(),
            'product_id'=>$product->id,
            'quantity'=>$quantity
        ]);
    }

    public function update(Product $product, $quantity)
    {
        Cart::where('product_id' ,' == ', $product->id)
        ->where('cookie_id','=',$this->getcookieid())
        ->update([
            'quantity'=>$quantity
        ]);
    }

    public function delete($id)
    {
        Cart::where('id','==',$id)
        ->where('cookie_id','=',$this->getcookieid())
        ->delete();
    }
    public function empty()
    {
        Cart::where('cookie_id','=',$this->getcookieid())->destroy();
    }
    public function total()
    {
        return Cart::where('cookie_id','=',$this->getcookieid())->
        join('products','products.id','=','carts.product_id')->
        selectRaw('SUM(products.price * cart.quantity) as total')
        ->value('total');
    }

    protected function getcookieid(){
        $cookie_id = Cookie::get('cart_id');
        if(!$cookie_id){
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id',$cookie_id, Carbon::now()->addDays(30));
        }
        return $cookie_id;
    }
}


?>