<?php

use Illuminate\Database\Seeder;

class RequestCallbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('request_callback')->insert(
        ['name_clients' => 'Ivan',
        'telephon' => '380995372639',
        'email' => 'zatsepin@accbox.info',
        'message'=>'Hello!'
        ]);
    }
}
