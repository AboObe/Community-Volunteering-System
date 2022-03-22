<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Animal', 
            'description' => 'Lost and Found Animals Ads',
            'image' =>'dist/img/animal.png',
        ]);

        Category::create([
            'name' => 'Wallet', 
            'description' => 'Lost wallets found ads',
            'image' =>'dist/img/wallet.jpg',
        ]);

        Category::create([
            'name' => 'Keys', 
            'description' => 'Lost Keys Found Ads',
            'image' =>'dist/img/keys.jpg',
        ]);

        Category::create([
            'name' => 'Jewelery and watches', 
            'description' => 'Lost and Found Jewelry and Watches Ads',
            'image' =>'dist/img/jewelery.jpg',
        ]);

        Category::create([
            'name' => 'Personal Property', 
            'description' => 'Lost and Found Personal Property Ads',
            'image' =>'dist/img/Personal Property.jpg',
        ]);

        Category::create([
            'name' => 'Other', 
            'description' => 'Other lost && found items',
            'image' =>'dist/img/other.png',
        ]);
    }
}
