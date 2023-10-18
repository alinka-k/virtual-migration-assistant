<?php

namespace App\Console\Commands\Profile;

use App\Jobs\Profile\Parse as ParseProfileJob;
use Illuminate\Console\Command;

class Parse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'profile:parse {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse profiles information from service.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id = $this->argument('id');
        ParseProfileJob::dispatch($id);

        return 'Started parsing profile ' . $id;
    }
}
