<?php

namespace App\Jobs\Profile;

use App\Exceptions\ParseProfileException;
use App\Services\Profile\ProfileService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Parse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $user_id;

    /**
     * Create a new job instance.
     *
     * @param string $user_id
     */
    public function __construct(string $user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @param ProfileService $service
     * @return bool
     * @throws ParseProfileException
     */
    public function handle(ProfileService $service)
    {
        return $service->parseExistingProfile($this->user_id);
    }
}
