<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Crud;

class CrudSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Crud::create([
            'name' => 'Ali Khan',
            'email' => 'ali@example.com'
        ]);

        Crud::create([
            'name' => 'Sara Ahmed',
            'email' => 'sara@example.com'
        ]);
    }
}
