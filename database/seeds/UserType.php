<?php

use Illuminate\Database\Seeder;

class UserType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User_Type::class, 10)->create();
    }
}
