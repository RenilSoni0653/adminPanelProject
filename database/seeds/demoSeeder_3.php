<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class demoSeeder_3 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=20;$i++)
        {
            $data = \DB::table('demo_test_3')->insert([
                'text' => Str::random(20),
                'demo_2' => 1
            ]);
        }
    }
}
