<?php

use Illuminate\Database\Seeder;

class MemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 400; $i++)
        {
            $randomLike = rand(0,1000);
            $randomDislike = rand(0,1000);
            $int= rand(1262055681,1262055681);
            $date = date("Y-m-d H:i:s",$int);

            DB::table('memes')->insert([
                'title' => Str::random(30),
                'photoPath' => "photo.jpg",
                'likes' => $randomLike,
                'dislikes' => $randomDislike,
                'author' => 1,
                'created_at'=> $date,
            ]);
        }
    }
}
