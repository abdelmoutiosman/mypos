<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=['cat one','cat two','cat three','cat Four','cat five','cat six','cat seven'];

        foreach ($categories as $category) {
            \App\Category::create([
                'name'=>$category,
            ]);
        }
    }
}
