<?php

use Illuminate\Database\Seeder;

class TaskUserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        $data = [];
        for ($i = 0; $i < 50; $i++) {
            $user_id = mt_rand(1, 129);
            $task_id = mt_rand(1, 20);
            $data[] = ['user_id' => $user_id, 'task_id' => $task_id];
        }
        DB::table('task_user')->insert($data);
    }

}
