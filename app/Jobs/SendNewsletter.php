<?php

namespace App\Jobs;

use App\Mail\NewsletterMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendNewsletter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $subscribers;
    protected $newsContent;
    protected $newsId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($subscribers, $newsContent, $newsId)
    {
        $this->subscribers = $subscribers;
        $this->newsContent = $newsContent;
        $this->newsId = $newsId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->subscribers as $subscriber) {
            try {
                Mail::to($subscriber->email)->send(new NewsletterMail($this->newsContent, $this->newsId));
            } catch (\Exception $e) {
                // Log the exception
                Log::error('Failed to send email to ' . $subscriber->email . ': ' . $e->getMessage());
            }
        }
    }
}
