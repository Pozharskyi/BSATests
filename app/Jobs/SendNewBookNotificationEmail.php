<?php

namespace App\Jobs;

use App\Book;
use App\Jobs\Job;
use App\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewBookNotificationEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;


    protected $book;

    /**
     * Create a new job instance.
     *
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Execute the job.
     *
     * @param Mailer $mailer
     */
    public function handle(Mailer $mailer)
    {
//        $this->release(50);
        $users = User::all();
        foreach($users as $user){
            $mailer->send('emails.new_book_notify', ['user' => $user, 'book' => $this->book], function ($message) use ($user){
                $message->to($user->email)->subject('New book available');
            });
        }

    }
}
