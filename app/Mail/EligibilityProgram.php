<?php

namespace App\Mail;

use App\Models\Evaluate\Evaluation;
use App\Repositories\EligibilityProgramRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EligibilityProgram extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Great news on your eligibility to immigrate to Canada';
    public $view = 'emails.eligibility.programs';

    private Evaluation $evaluation;

    public function __construct(Evaluation $evaluation)
    {
        $this->evaluation = $evaluation;
    }

    public function build(): self
    {
        return $this->with([
            'programs' => $this->getPrograms(),
            'name' => $this->evaluation->user->first_name,
        ]);
    }

    private function getPrograms(): array
    {
        return EligibilityProgramRepository::getLabelsByIds($this->evaluation->eligibilityFormatted);
    }
}
