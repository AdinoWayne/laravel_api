<?php

use Illuminate\Database\Seeder;

class UserLog extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User_Log::class, 10)->create();
    }
}
