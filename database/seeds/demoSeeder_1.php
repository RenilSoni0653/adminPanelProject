<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class demoSeeder_1 extends Seeder
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
            $data = \DB::table('demo_test_1')->insert([
                'text' => Str::random(20)
            ]);
        }
    }
}
