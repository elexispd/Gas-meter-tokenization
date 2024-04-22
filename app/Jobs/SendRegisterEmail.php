<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
class SendRegisterEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $name;
    private $username;
    private $password;


    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($name, $username, $password)
    {
        $this->name = $name; $this->username = $username; $this->password = $password;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::to($this->username)->send(new RegisterMail($this->name, $this->username, $this->password));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
