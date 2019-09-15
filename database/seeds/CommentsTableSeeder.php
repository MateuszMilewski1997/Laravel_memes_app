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
        for($i = 0; $i <= 10000; $i++)
        {
            $mem = rand(1,400);
            $length = rand(1,200);

            DB::table('comments')->insert([
                'content' => Str::random($length),
                'mem' => $mem,
                'author' => 1,
            ]);
        }
    }
}
