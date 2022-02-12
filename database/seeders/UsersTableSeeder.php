<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $user = User::create([
            'name' => 'Robert',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $this->command->info('Database is ready with default user.');
    }
}
