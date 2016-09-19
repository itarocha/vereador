<?php


//
use Illuminate\Database\Seeder;

use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan migrate
        // php artisan db:seed
        $this->call(UsersTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $usuarios = User::get();

        if($usuarios->count() == 0) {
            User::create(array(
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'name'  => 'Administrador',
                'isAdmin'  => 'S',
                'podeAlterar'  => 'S',
                'podeIncluir'  => 'S',
                //'tipo'  => 'admin'
            ));
        }
    }

}
