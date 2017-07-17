<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Modules\Event\Event;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::create([
        	'name'	=>	'Guiller Celestino',
        	'email' =>	'celestinoguiller@gmail.com',
        	'password'	=>	bcrypt('password'),
        	'is_active' => 1,
        ]);

        factory(Event::class, 20);
    }
}
