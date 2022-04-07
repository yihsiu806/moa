<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Division;
use App\Models\Files;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->division();
        $this->users();
        // $this->files();
    }

    public function division()
    {
        User::insert([
            'name' => 'Statics Unit',
            'icon' => null,
            'picture' =>  null,
            'slug' => 'stati',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::insert([
            'name' => 'Statics Unit',
            'icon' => null,
            'picture' =>  null,
            'slug' => 'stati',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::insert([
            'name' => 'Statics Unit',
            'icon' => null,
            'picture' =>  null,
            'slug' => 'stati',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::insert([
            'name' => 'Statics Unit',
            'icon' => null,
            'picture' =>  null,
            'slug' => 'stati',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::insert([
            'name' => 'Statics Unit',
            'icon' => null,
            'picture' =>  null,
            'slug' => 'stati',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    public function users()
    {
        User::insert([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' =>  'admin',
            'division' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $firstDivision = Division::select('id')->first();
        if ($firstDivision) {
            $firstDivision = $firstDivision->id;
        }
        User::insert([
            'username' => 'division',
            'password' => Hash::make('division'),
            'role' =>  'division',
            'division' => $firstDivision,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        User::insert([
            'username' => 'vierer',
            'password' => Hash::make('vierer'),
            'role' =>  'viewer',
            'division' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }



    public function files()
    {
        Files::factory(100)->create();
    }
}
