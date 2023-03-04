<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => bcrypt('password'),
            'admin' => 1
        ]);

        foreach (config('cms') as $key => $value):
            \App\Models\Setting::create([
                'key' => $key,
                'value' => $value
            ]);
        endforeach;
    }
}
