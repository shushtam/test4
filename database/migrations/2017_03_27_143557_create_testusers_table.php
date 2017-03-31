<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestusersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('testusers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
        $emails = ["user1@gmail.com", "user2@gmail.com", "user3@gmail.com", "user4@gmail.com", "user5@gmail.com",
            "user6@gmail.com", "user7@gmail.com", "user8@gmail.com", "user9@gmail.com", "user10@gmail.com"];

        for ($i = 0; $i < 100; $i++) {

            $pass = $this->randomString();
            $pass = bcrypt($pass);
            DB::table('users')->insert(
                    [
                        'name' => $this->randomString(),
                        'email' => $emails[rand(0, 9)],
                        'password' => $pass
                    ]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('testusers');
    }

    private function randomString() {
        $str = "";
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < 8; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

}
