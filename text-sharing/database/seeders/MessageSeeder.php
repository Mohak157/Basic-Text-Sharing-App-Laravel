<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        
        $users = User::count() < 5
				    ? collect([
				        User::create([
				            'name' => 'Alice Developer',
				            'email' => 'alice@example.com',
				            'password' => bcrypt('password'),
				        ]),
				        User::create([
				            'name' => 'Bob Builder',
				            'email' => 'bob@example.com',
				            'password' => bcrypt('password'),
				        ]),
				        User::create([
				            'name' => 'Charlie Coder',
				            'email' => 'charlie@example.com',
				            'password' => bcrypt('password'),
				        ]),
				    ])
				    : User::take(3)->get();

  
        $messages = [
            'Just discovered Laravel - where has this been all my life? 🚀',
            'Building something cool with Chirper today!',
            'Laravel\'s Eloquent ORM is pure magic ✨',
            'Deployed my first app with Laravel Cloud. So smooth!',
            'Who else is loving Blade components?',
            'Friday deploys with Laravel? No problem! 😎',
        ];

        foreach ($messages as $message) {
            $users->random()->messages()->create([
                'message' => $message,
                'created_at' => now()->subMinutes(rand(5, 1440)),
            ]);
        }
    }
}