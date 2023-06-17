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
        \App\Models\User::factory(10)->create();

        foreach (range(1, 10) as $iteration) {
            \App\Models\Task::factory()->create([
                'title' => 'Title'.$iteration,
                'description' => 'description'.$iteration,
            ]);
        }
    }
}
