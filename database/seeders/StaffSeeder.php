<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Kak Febri';
        $user->username = 'febri';
        $user->email = 'febri@mail.com';
        $user->password = \Hash::make('anubener?');
        $user->level = 'staff';
        $user->save();
        $this->command->info('User staff berhasil diinsert');
        
        $user = new User;
        $user->name = 'Kak Irsan';
        $user->username = 'irsan';
        $user->email = 'irsan@mail.com';
        $user->password = \Hash::make('apaiya?');
        $user->level = 'staff';
        $user->save();
        $this->command->info('User staff berhasil diinsert');
    }
}
