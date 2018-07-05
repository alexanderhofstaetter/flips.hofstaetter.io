<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Exam;
use App\Mail\ExamAdded;
use App\Mail\ExamUpdated;

class ExamEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function examCreated(Exam $exam)
    {
        if ( $exam->date >= Carbon::now()->subMinutes(15) )
            Mail::to( $exam->user )->send(new ExamAdded( $exam ));
    }

    public function examUpdated(Exam $exam)
    {
        if ( $exam->date >= Carbon::now()->subMinutes(15) )
           Mail::to( $exam->user )->send(new ExamUpdated( $exam ));
    }
}
