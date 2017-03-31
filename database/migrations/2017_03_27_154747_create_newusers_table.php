<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewusersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        for ($i = 0; $i < 100; $i++) {

            $pass = $this->randomString();
            $pass = bcrypt($pass);
            \DB::table('users')->insert(
                    [
                        'name' => $this->randomString(),
                        'email' => $this->randomString(),
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
        Schema::dropIfExists('newusers');
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
