<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products=['pro one','pro two','pro three','pro four','pro five','pro six'];

        foreach ($products as $product) {
            \App\Product::create([
                'name'=>$product,
                'description'=>$product . ' desc',
                'category_id'=>1,
                'purchase_price'=>100,
                'sale_price'=>150,
                'stock'=>100,
            ]);
        }
    }
}
