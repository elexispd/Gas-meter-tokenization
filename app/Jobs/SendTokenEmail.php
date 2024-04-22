<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TokenMail;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendTokenEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $details;
    protected $token;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Purchase $details, string $token)
    {
        $this->user = $user;
        $this->details = $details;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::to($this->user->email)->send(new TokenMail($this->user, $this->details, $this->token));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
