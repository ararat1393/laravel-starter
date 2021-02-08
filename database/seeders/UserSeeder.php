<?php

namespace Database\Seeders;

use App\Models\Phone;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->has(
                Photo::factory()
                    ->state(function (array $attributes,User $user){
                        return ['user_name' => $user->name];
                    })
                    ->state(new Sequence(['status' => '1'], ['status' => '0'],
                    ))
                    ->count(5)
            )
            ->count(10)
            ->create();
    }

}
