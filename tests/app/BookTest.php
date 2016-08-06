<?php

use App\User;
use App\Book;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookTest extends TestCase
{
    use DatabaseMigrations;

    protected $book = [
        'title' => 'testTitle',
        'author' => 'testAuthor',
        'year' => 1999,
        'genre' => 'Horror'
    ];
    protected $user = ['lastName' => 'testLastName',
        'firstName' => 'testFirstName',
        'email' => 'test@test.com'];

    public function setUp()
    {
        parent::setUp();

    }

    /** @test */
    public function testBookShouldBeCreated()
    {
        $book = Book::create($this->book);
        $book->save();
        $this->seeInDatabase('books', $this->book);
    }

    /** @test */
    public function testBookShouldBeDeleted()
    {
        $book = Book::create($this->book);
        $book->save();

        $book->delete();
        $this->notSeeInDatabase('books', $this->book);
    }
    /** @test */
    public function testBookShouldBeUpdated()
    {
        $book = Book::create($this->book);
        $book->save();

        $book->update(['title' => 'newTestTitle']);
        $this->seeInDatabase('books', array_merge($this->book,['title' => 'newTestTitle'] ));
    }


    /** @test */
    public function testBookShouldBeCreatedFromUser()
    {
        $user = User::create($this->user);
        $user->save();
        $user->books()->create($this->book);
        $this->seeInDatabase('books', array_merge($this->book, ['user_id' => $user->id]));

    }
    /** @test */
    public function testBookShouldBeDeletedFromUser()
    {
        $user = User::create($this->user);
        $user->save();
        $user->books()->create($this->book);

        $book = Book::where($this->book)->firstOrFail();
        $user->books()->delete($book);
        $this->notSeeInDatabase('books', array_merge($this->book, ['user_id' => $user->id]));

    }
    /** @test */
    public function testBookShouldBeAssociateToUser()
    {
        $user = User::create($this->user);
        $user->save();
        $book = Book::create($this->book);
        $book->user()->associate($user);
        $book->save();

        $this->seeInDatabase('books', array_merge($this->book, ['user_id' => $user->id]));

    }
    /** @test */
    public function testBookShouldBeDissociateFromUser()
    {
        $user = User::create($this->user);
        $user->books()->create($this->book);
        $user->save();

        $book = Book::where('user_id',$user->id)->firstOrFail();
        $book->user()->dissociate();
        $book->save();

        $this->notSeeInDatabase('books', array_merge($this->book, ['user_id' => $user->id]));

    }

    /** @tearDown */
    public function tearDown()
    {
        parent::tearDown();
    }
}
