<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Banana;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users
        User::factory(5)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create mock banana data
        Banana::factory(15)->create();
        
        // Create some premium bananas
        Banana::factory(3)->premium()->create();
        
        // Create one out of stock banana
        Banana::factory()->outOfStock()->create([
            'name' => 'Rare Golden Banana',
        ]);
    }
}
