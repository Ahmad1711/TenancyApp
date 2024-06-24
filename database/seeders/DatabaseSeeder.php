<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // foreach(Store::factory(3)->create() as $store){
        //     foreach(Category::factory(3)->create(['store_id'=>$store->id]) as $category){
        //         foreach(Product::factory(3)->create(['store_id'=>$store->id,'category_id'=>$category->id]) as $product){

        //         }
        //     }
        // }

        Store::factory(3)->has(Category::factory(3)->hasProducts(3,function($attrs,$category){
            $attrs['store_id']=$category->store_id;
            return $attrs;
        }))->create();
    }
}
