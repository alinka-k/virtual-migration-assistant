<?php

namespace App\Console\Commands\Evaluating;

use App\Jobs\Evaluation\Evaluate as EvaluateJob;
use Illuminate\Console\Command;

class Evaluate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evaluate:fire {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs General Immigration evaluations with the provided candidate.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        EvaluateJob::dispatch($this->argument('user'));
        return 'Profile evaluated.';
    }
}
