<?php

namespace App\Mail;

use App\Http\Requests\Form\QuestionFormRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ImmigrationQuestionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $formData;

    public function __construct(QuestionFormRequest $formData)
    {
        $this->formData = $formData->all();
    }

    public function build()
    {
        return $this
            ->to(config('mail.to.migration_assistant_support'))
            ->subject('Question From MigrationAssistant')
            ->view('emails.form.question', [
                'fullName' => $this->formData['fullName'] ?: 'field is not filled',
                'email' => $this->formData['email'],
                'question' => $this->formData['question'],
                'shouldReceiveNewsletter' => $this->formData['shouldReceiveNewsletter'],
            ]);
    }
}
