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
        Division::insert([
            'name' => 'Statics Unit',
            'icon' => null,
            'picture' =>  null,
            'slug' => 'stati',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Division::insert([
            'name' => 'Fisheries',
            'icon' => null,
            'picture' =>  null,
            'slug' => 'fisheries',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Division::insert([
            'name' => 'Forestry',
            'icon' => null,
            'picture' =>  null,
            'slug' => 'forestry',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Division::insert([
            'name' => 'Research & Development',
            'icon' => null,
            'picture' =>  null,
            'slug' => 'research',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Division::insert([
            'name' => 'Propagation Division',
            'icon' => null,
            'picture' =>  null,
            'slug' => 'propagation',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Division::insert([
            'name' => 'Water Resource Management',
            'icon' => null,
            'picture' =>  null,
            'slug' => 'water',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Division::insert([
            'name' => 'Agriculture & Engineering Services Division',
            'icon' => null,
            'picture' =>  null,
            'slug' => 'engineer',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Division::insert([
            'name' => 'Veterinary & Livestock Services',
            'icon' => null,
            'picture' =>  null,
            'slug' => 'livestock',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    public function users()
    {
        User::insert([
            'username' => 'admin',
            'password' => Hash::make('admin_2022'),
            'role' =>  'admin',
            'division' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $firstDivision = Division::select('id')->first();
        if ($firstDivision) {
            User::insert([
                'username' => 'division',
                'password' => Hash::make('division_2022'),
                'role' =>  'division',
                'division' => $firstDivision->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        User::insert([
            'username' => 'viewer',
            'password' => Hash::make('viewer_2022'),
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
