<?php

use App\Models\Profile;
use App\User;
use Illuminate\Database\Seeder;

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
            'first_name' => 'kkr for the win',
            'last_name'  => 'admin',
            'email'      => 'rahmat.awaludin@gmail.com',
            'password'   => bcrypt('sukseskkr2018'),
            'level'      => User::ACCESS_ADMIN,
        ]);

        $member = factory(User::class)->create([
            'first_name' => 'Anhar',
            'last_name'  => 'Solehudin',
            'email'      => 'anhsbolic@gmail.com',
            'password'   => bcrypt('anharsolehudin'),
            'level'      => User::ACCESS_MEMBER,
        ]);

        factory(Profile::class)->create(['member_id' => $member->id]);

        factory(User::class, 50)->create([
            'level' => User::ACCESS_MEMBER,
        ])->each(function ($freelancer) {
            factory(Profile::class)->create(['member_id' => $freelancer->id]);
        });
    }
}
