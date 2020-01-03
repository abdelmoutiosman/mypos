<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients=['abdo','ahmed','mohamed','ali','sayed'];

        foreach ($clients as $client) {
            \App\Client::create([
                'name'=>$client,
                'phone'=>'52235233544',
                'address'=>'mansoura',
            ]);
        }
    }
}
