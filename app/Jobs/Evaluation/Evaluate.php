<?php

namespace App\Jobs\Evaluation;

use App\Exceptions\JobFailedException;
use App\Services\Evaluation as EvaluationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Evaluate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $user_id;

    /**
     * Create a new job instance.
     *
     * @param $user_id
     */
    public function __construct(string $user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @param EvaluationService $service
     * @return void
     * @throws JobFailedException
     */
    public function handle(EvaluationService $service)
    {
        $success = $service->create($this->user_id);
        if (!$success) {
            throw new JobFailedException('Data has not been handled yet.');
        }
    }
}
