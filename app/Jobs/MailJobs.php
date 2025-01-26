<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $email;
   public $codetak;
 

    public function __construct($codetak, $email)
    {
        $this->email = $email;
        $this->codetak = $codetak;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       Mail::raw("Tasdiqlash Codingiz: {$this->codetak}", function ($message){
        $message->to($this->email)->subject("Tasdiqlash Code");
       });
    }
}
