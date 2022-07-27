<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Role;
use App\Models\StockYard;
use App\Models\TxnLog;
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
        Role::factory()->count(3)->create();
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Sagar Karn',
            'email' => 'admin@gmail.com',
        ]);

        Product::factory(10)->create();
        StockYard::factory(10)->create();
        Customer::factory(10)->create();
        TxnLog::factory(10)->create();
    }
}
