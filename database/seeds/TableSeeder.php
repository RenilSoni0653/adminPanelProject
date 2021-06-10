<?php

use App\Table;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=10;$i++)
        {
            $table = Table::create([
                'user_id' => 1,
                'name' => Str::random(10),
                'position' => Str::random(5),
                'office' => Str::random(10),
                'start_date' => '2021/09/20',
                'age' => 35,
                'salary' => 20000,
            ]);
        }
    }
}
