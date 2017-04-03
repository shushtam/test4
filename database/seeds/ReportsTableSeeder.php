<?php

use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        $data = [];
        for ($i = 0; $i < 1000; $i++) {
            $randomUser = App\Models\User::inRandomOrder()->first();
            $timestamp = mt_rand(1, time());
            $randomDate = date("Y-m-d H:i:s", $timestamp);
            $data[] = ['user_id' => $randomUser->id, 'value' => mt_rand(1, 100), 'created_at' => $randomDate, 'updated_at' => $randomDate];
        }
        DB::table('reports')->insert($data);
    }

}
