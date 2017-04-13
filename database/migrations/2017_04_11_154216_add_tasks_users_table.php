<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTasksUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_user', function (Blueprint $table) {
            //
            $data = [];
        for ($i = 0; $i < 129; $i++) {
            $user_id = mt_rand(1, 129); 
        }
        for ($i = 0; $i < 20; $i++) {
            $task_id = mt_rand(1, 20);
        }
            $data[] = ['user_id' => $user_id, 'task_id' =>$task_id];
        
        DB::table('task_user')->insert($data);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_user', function (Blueprint $table) {
            //
        });
    }
}
