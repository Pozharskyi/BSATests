<?php

use App\Book;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BooksControllerTest extends TestCase
{
    use Illuminate\Foundation\Testing\DatabaseMigrations;
    const BOOKS_AMOUNT = 9;
    protected $books;
    protected $users;

    public function setUp()
    {
        parent::setUp();
        $this->users = factory(App\User::class, 2)->create();
        $usersId = $this->users->lists('id')->toArray();
        $this->books = factory(App\Book::class, self::BOOKS_AMOUNT)->create(['user_id' => $usersId[array_rand($usersId)]]);
    }

    /** @test */
    public function testIndexShouldResponseStatusOk()
    {

        $this->json('GET', route('api.v1.books.index'))
            ->assertResponseStatus(200);
    }

    /** @test */
    public function testIndexShouldReturnAllBooksJSON()
    {


        $this->call('Get', route('api.v1.books.index'));
        foreach ($this->books as $book) {
            $this->seeJson([
                'title' => $book->title,
                'author' => $book->author,
                'genre' => $book->genre,
                'year' => (integer)$book->year,
                'userId' => $book->user_id
            ]);
        }
//        $this->json('Get', route('api.v1.books.index'))
//            ->seeJson($books->toArray());
    }

    /** @test */
    public function testShowShouldResponseStatusOkWhenBookExist()
    {


        $book = Book::findOrFail(rand(1, self::BOOKS_AMOUNT));

        $this->json('GET', route('api.v1.books.show', [$book->id]))
            ->assertResponseStatus(200);
    }

    /** @test */
    public function testShowShouldResponseBookWhenBookExist()
    {


        $book = Book::findOrFail(rand(1, self::BOOKS_AMOUNT));

        $this->json('GET', route('api.v1.books.show', [$book->id]))
            ->seeJson([
                'title' => $book->title,
                'author' => $book->author,
                'genre' => $book->genre,
                'year' => (integer)$book->year,
                'userId' => $book->user_id
            ]);
    }

    /** @test */
    public function testShowShouldResponseStatus404WhenBookDoesNotExist()
    {

        $notExistId = count($this->books->toArray()) + 1;
        $this->json('GET', route('api.v1.books.show', [$notExistId]))
            ->seeStatusCode(404);
    }

    /** @test */
    public function testDestroyShouldResponse204WhenBookExist()
    {
        $book = Book::findOrFail(rand(1, self::BOOKS_AMOUNT));

        $this->json('DELETE', route('api.v1.books.destroy', [$book->id]))
            ->assertResponseStatus(204);
    }

    /** @test */
    public function testDestroyShouldResponse404WhenBookNotExist()
    {
        $notExistId = count($this->books->toArray()) + 1;
        $this->json('DELETE', route('api.v1.books.destroy', [$notExistId]))
            ->seeStatusCode(404);
    }

    /** @test */
    public function testDestroyShouldDeleteBookWhenExist()
    {
        $book = Book::findOrFail(rand(1, self::BOOKS_AMOUNT));

        $this->call('DELETE', route('api.v1.books.destroy', [$book->id]));
        $this->notSeeInDatabase('books', ['id' => $book->id]);
    }

    /** @test */
    public function testStoreShouldResponseStatusOkWhenBookValid()
    {
        $this->json('POST', route('api.v1.books.store'), [
            'title' => 'testTitle',
            'author' => 'testAuthor',
            'year' => 1999,
            'genre' => 'Horror'
        ])->seeStatusCode(201);

    }

    /** @test */
    public function testStoreShouldSaveBookWhenBookValid()
    {
        $this->json('POST', route('api.v1.books.store'), [
            'title' => 'testTitle',
            'author' => 'testAuthor',
            'year' => 1999,
            'genre' => 'Horror'
        ])->seeInDatabase('books', [
            'title' => 'testTitle',
            'author' => 'testAuthor',
            'year' => 1999,
            'genre' => 'Horror'
        ]);
    }

    /** @test */
    public function testStoreShouldResponseStatus422WhenBookNotValid()
    {
        $this->json('POST', route('api.v1.books.store'), [
            'title' => 123,
            'author' => 'testAuthor',
            'year' => 1999,
            'genre' => 'Horror'
        ])->seeStatusCode(422);

//        $this->json('POST', route('api.v1.books.store'), [
//            'title' => 'testTitle',
//            'author' => 'testAuthor asdasd',
//            'year' => 1999,
//            'genre' => 'Horror'
//        ])->seeStatusCode(422);

        $this->json('POST', route('api.v1.books.store'), [
            'title' => 'testTitle',
            'author' => 'testAuthor',
            'genre' => 'Horror'
        ])->seeStatusCode(422);

        $this->json('POST', route('api.v1.books.store'), [
            'title' => 'testTitle',
            'author' => 'testAuthor',
            'year' => 'string',
            'genre' => 'Horror'
        ])->seeStatusCode(422);

        $this->json('POST', route('api.v1.books.store'), [
            'title' => 'testTitle',
            'author' => 'testAuthor',
            'year' => 1999,
            'genre' => 'Horror34'
        ])->seeStatusCode(422);
    }


    public function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }
}
