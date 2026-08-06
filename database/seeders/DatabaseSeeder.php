<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed default Admin User
        if (User::where('email', 'admin@gmail.com')->doesntExist()) {
            User::create([
                'name'     => 'Administrator',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]);
        }

        // Seed default Categories
        if (Category::count() === 0) {
            $defaultCategories = ['Teknologi', 'Politik', 'Olahraga', 'Hiburan', 'Edukasi'];
            foreach ($defaultCategories as $cat) {
                Category::create([
                    'category_name' => $cat,
                ]);
            }
        }
    }
}
