<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert([
            [
                'title'=>'Проснувшись однажды утром после беспокойного сна, Грегор Замза обнаружил,
                 что он у себя в постели.',
                'alias'=>'verter',
                'body'=>'превратился в страшное насекомое. Лежа на панцирнотвердой спине, он видел, стоило ему приподнять
                 голову, свой коричневый, выпуклый, разделенный дугообразными чешуйками живот, на верхушке которого еле де',
                'img_way'=>'http://lorempixel.com/output/people-q-c-600-200-1.jpg'
            ],[
                'title'=>'Душа моя озарена неземной радостью, как эти чудесные весенние утра,
                     которыми я наслаждаюсь от всего.',
                'alias'=>'kafka',
                'body'=>'Я совсем один и блаженствую в здешнем краю, словно созданном для таких, как я. Я так счастлив, 
                мой друг, так упоен ощущением покоя, что искусство мое страдает от этого. Ни одного штриха не мог',
                'img_way'=>'http://lorempixel.com/output/sports-q-c-600-200-1.jpg',
            ]
        ]);
    }
}
