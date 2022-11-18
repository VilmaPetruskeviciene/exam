<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $time = Carbon::now();
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123'),
            'created_at' => $time,
            'updated_at' => $time,
            'role' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'created_at' => $time,
            'updated_at' => $time,
            'role' => 10
        ]);

        foreach(['Fantasy', 'Sci-fi', 'Mystery', 'Thriller', 'Romance'] as $cat) {
            DB::table('categories')->insert([
                'title' => $cat,
                'created_at' => $time->addSeconds(1),
                'updated_at' => $time
            ]);
        }

        foreach([
            'The Light We Carry',
            'The Boys from Biloxi',
            'Harry Potter and the Order of the Phoenix',
            'The Book of Unusual Knowledge',
            'Bear Stays Up for Christmas ',
            'November 9'
        ] as $book) {
            DB::table('books')->insert([
                'title' => $book,
                'ISBN' => rand(100, 1000),
                'pages' => rand(150, 500),
                'category_id' => rand(1, 5),
                'created_at' => $time->addSeconds(1),
                'updated_at' => $time
            ]);
        }

    }
}
