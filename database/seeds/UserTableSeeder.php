<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Profile;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'kkr for the win',
            'email' => 'rahmat.awaludin@gmail.com',
            'password' => bcrypt('sukseskkr2018'),
            'level' => User::ACCESS_ADMIN        
        ]);

        $member = factory(User::class)->create([
            'name' => 'Anhar Solehudin',
            'email' => 'anhsbolic@gmail.com',
            'password' => bcrypt('anharsolehudin'),
            'level' => User::ACCESS_MEMBER
        ]);

        factory(Profile::class)->create(['member_id' => $member->id]);
    }
}
