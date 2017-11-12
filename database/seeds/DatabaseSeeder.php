<?php

use Illuminate\Database\Seeder;
use App\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Role::create([
    		'role' => 'ADMIN',
    	]);
    	Role::create([
    		'role' => 'BUREAU',
    	]);
    	Role::create([
    		'role' => 'MJ',
    	]);
    	Role::create([
    		'role' => 'PJ',
    	]);
    	Role::create([
    		'role' => 'PNJ',
    	]);
    	factory(App\User::class, 50)->create();
    	factory(App\Article::class, 20)->create();
    	factory(App\Game::class, 30)->create();
        // $this->call(UsersTableSeeder::class);
    }
}
