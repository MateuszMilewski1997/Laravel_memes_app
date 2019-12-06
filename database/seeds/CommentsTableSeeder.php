<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i <= 40; $i++)
        {
            $mem = rand(1,2);
            $length = rand(1,100);

            DB::table('comments')->insert([
                'content' => Str::random($length),
                'mem_id' => $mem,
            ]);
        }
    }
}
