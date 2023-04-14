<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('eventtypes')->insert([
            'id'=>1,
            'name' => 'Concert',
        ]);
        DB::table('eventtypes')->insert([
            'id'=>2,
            'name' => 'Charity',
        ]);
        DB::table('eventtypes')->insert([
            'id'=>3,
            'name' => 'Product',
        ]);
    }

}
