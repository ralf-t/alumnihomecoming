<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultValueForUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = new User;

        $user->fill([
            'first_name' => 'R&D',
            'last_name' => 'Unit',
            'username' => 'rndunit',
            'password' => 'rndccss2008',
            'type' => 'ADMIN',
        ]);

        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
