<?php

namespace App\Jobs;

use App\Http\Requests\WeatherGetRequest;
use App\Models\ClientRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendClientRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $request;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $client_request)
    {
        $this->request = $client_request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ClientRequest::create($this->request);
    }
}
