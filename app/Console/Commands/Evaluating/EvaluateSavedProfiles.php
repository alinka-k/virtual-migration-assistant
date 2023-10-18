<?php

namespace App\Console\Commands\Evaluating;

use App\Services\Evaluation;
use Illuminate\Console\Command;

class EvaluateSavedProfiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evaluate:saved-profiles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Evaluate not evaluated profiles.';

    /**
     * Execute the console command.
     *
     * @param Evaluation $service
     * @return mixed
     */
    public function handle(Evaluation $service)
    {
        $service->evaluateNotSubmitted();
        return 'Profiles were evaluated.';
    }
}
