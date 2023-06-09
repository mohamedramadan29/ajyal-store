<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        /*
        User::create([
            'name'=>'admin',
            'email'=>'mr319242@gmail.com',
            "password"=>Hash::make('admin'),
            'phone'=>"01011642731",
        ]);
        DB::table('users')->insert([
            'name'=>'mohamed',
            'email'=>'mohamed@gmail.com',
            'password'=>Hash::make('11111111'),
            'phone'=>'010116427311'
        ]);
        */
        // to create factory
       Store::factory('5')->create();
       Category::factory('10')->create();
       Product::factory('100')->create();
    }
}
