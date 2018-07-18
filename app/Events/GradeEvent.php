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
use App\Grade;
use App\Mail\GradeUpdated;

class GradeEvent
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

    public function gradeCreated(Grade $grade)
    {
        if ( $grade->entry_date >= Carbon::now()->subDays(1) )
            Mail::to( $grade->user )->send(new GradeUpdated( $grade ));
    }

    public function gradeUpdated(Grade $grade)
    {
        if ( $grade->entry_date >= Carbon::now()->subDays(1) )
            Mail::to( $grade->user )->send(new GradeUpdated( $grade ));
    }
}
