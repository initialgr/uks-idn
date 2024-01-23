<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user-> name = 'Administrator';
        $user-> username = 'admin';
        $user-> email = 'admin@mail.com';
        $user-> password = \Hash::make('apaajabolehdong');
        $user-> level = 'admin';
        $user-> save();
        $this->command->info('User admin berhasil diinsert');
    }
}
