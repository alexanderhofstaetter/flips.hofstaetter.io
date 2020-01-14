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

use App\Exam;
use App\Mail\ExamUpdated;
use Carbon\Carbon;

class ExamEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function examCreated(Exam $exam)
    {
        if ( $exam->date >= Carbon::now()->subDays(21) ) {
            Mail::to( $exam->user )->send(new ExamUpdated($exam));
        }
    }

    public function examUpdated(Exam $exam)
    {
        if ( $exam->date >= Carbon::now()->subDays(21) ) {
            Mail::to( $exam->user )->send(new ExamUpdated($exam));
        }
    }
}
