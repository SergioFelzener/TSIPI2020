<?php

use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = \App\store::all();

        foreach($stores as $store){
            $store->produtos()->save(factory(\App\produto::class)->make());

        }
    }
}
