<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'AC Cool',
                "price" => "80000",
                "description" => "Best Cooling with Fast Cool",
                "category" => "AC",
                "gallery" => "https://5.imimg.com/data5/SELLER/Default/2020/11/RZ/DA/OH/20728860/asgg12cgta-b-500x500.png",
            ],
            [
                'name' => 'Head Ear',
                "price" => "5000",
                "description" => "Good For Sound",
                "category" => "Earphone",
                "gallery" => "https://t3.ftcdn.net/jpg/03/89/61/56/360_F_389615629_QUCHDiTHaurKGcQAw1Z7pp2LZLy9OUye.jpg",
            ],
            [
                'name' => 'Smart Watch',
                "price" => "10000",
                "description" => "Best Quility All Feature",
                "category" => "Watch",
                "gallery" => "https://rukminim2.flixcart.com/image/850/1000/xif0q/shopsy-smartwatch/p/b/6/1-44-android-ios-t500-smart-watch-with-bluetooth-calling-black-original-imagvy24hyyqbzvm.jpeg?q=90&crop=false",
            ]
        ]);
    }
}
