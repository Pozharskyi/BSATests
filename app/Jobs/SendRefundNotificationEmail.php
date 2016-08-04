<?php

namespace App\Jobs;

use App\Book;
use App\Jobs\Job;
use App\User;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRefundNotificationEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;


    protected $user;
    protected $book;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param Book $book
     */
    public function __construct(User $user, Book $book)
    {
        $this->user = $user;
        $this->book = $book;
    }

    /**
     * Execute the job.
     *
     * @param Mailer $mailer
     */
    public function handle(Mailer $mailer)
    {
        $mailer->send('emails.new_book_notify', ['user' => $this->user, 'book' => $this->book], function ($message){
            $message->to($this->user->email)->subject('Refund the book');
        });
    }
}
