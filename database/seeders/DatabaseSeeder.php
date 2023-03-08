<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::disk('public')->deleteDirectory('uploads');

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => bcrypt('password'),
            'admin' => 1
        ]);

        foreach (config('cms.defaults') as $key => $value):
            \App\Models\Setting::create([
                'key' => $key,
                'value' => $value
            ]);
        endforeach;
    }
}
