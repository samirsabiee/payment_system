<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
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
        $this->initial();
        $this->fake();
    }

    public function initial()
    {

    }

    public function fake()
    {
        User::factory(10)->create();
        Product::factory(10)->create();
    }
}
