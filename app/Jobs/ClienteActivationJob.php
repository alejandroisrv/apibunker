<?php

namespace App\Jobs;

use App\Mail\ClienteActivacion;
use Illuminate\Support\Facades\Mail;

class ClientActivationJob extends Job
{

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user;
    public $config;

    public function __construct($user, $config)
    {
        $this->user = $user;
        $this->config = $config;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new ClienteActivacion($this->user, $this->config));
    }
}
