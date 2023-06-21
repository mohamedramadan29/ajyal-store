<?php 
namespace App\Repositories\cart;

use App\Models\Product;
use Illuminate\Support\Collection;

interface RepositoriesCart{
    public function get() : Collection;

    public function add(Product $product, $quantity = 1);

    public function update(Product $product , $quantity);

    public function delete($id);

    public function empty();

    public function total();
}

?>