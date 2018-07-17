<?php

namespace App\Mail;

use App\Exam;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class ExamUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $exam, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Exam $exam)
    {
        $this->exam = $exam;
        $this->user = $exam->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $file = storage_path( 'app/'.$this->exam->file);
        $filename = "Prüfunsgeinsicht-".$this->user->wulogin.".pdf";
        return $this->markdown('emails.exams.updated')
                    ->subject("[Flips] Es ist eine neue Prüfung zur Einsicht verfügbar")
                    ->attach($file, [
                        'as' => $filename,
                        'mime' => 'application/pdf',
                    ]);
    }
}
