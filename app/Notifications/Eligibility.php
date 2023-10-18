<?php

namespace App\Notifications;

use App\Mail\EligibilityProgram;
use App\Models\Evaluate\Evaluation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class Eligibility extends Notification
{
    use Queueable;

    /**
     * @var Evaluation
     */
    private Evaluation $evaluation;

    /**
     * Create a new notification instance.
     *
     * @param Evaluation $evaluation
     */
    public function __construct(Evaluation $evaluation)
    {
        $this->evaluation = $evaluation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new EligibilityProgram($this->evaluation))->build()->to($this->evaluation->user->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
