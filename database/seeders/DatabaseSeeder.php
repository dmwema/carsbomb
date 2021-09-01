<?php

namespace Database\Seeders;

use App\Models\CodeBomb;
use App\Models\player;
use App\Models\server;
use App\Models\Transfer;
use App\Models\Withdrawal;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        CodeBomb::factory(10)->create();
        player::factory(50)->create();
        server::factory(50)->create();
        Transfer::factory(10)->create();
        Withdrawal::factory(10)->create();
    }
}
