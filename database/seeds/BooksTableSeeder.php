<?php

use App\User;
use Illuminate\Database\Seeder;
use App\Book;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        factory(Book::class, 50)->create();
        $faker = Faker::create();
        $usersId = User::lists('id');
        //update user_id in books table with user[id] values
        foreach(range(1,50) as $index){
            $book = Book::find($index);
            $book->user_id = $faker->randomElement($usersId->all());
            $book->save();
        }
    }
}
