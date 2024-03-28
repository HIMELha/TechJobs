<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobNotificationMail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $employer;
    public $title;
    /**
     * Create a new job instance.
     */
    public function __construct($employer, $title)
    {
        $this->employer = $employer;
        $this->title = $title;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->employer->email)->send(new JobNotificationMail($this->employer, $this->title));
    }
}
