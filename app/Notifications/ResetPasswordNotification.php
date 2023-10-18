<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $user
     * @return MailMessage
     */
    public function toMail($user)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $user, $this->token);
        }
        if (static::$createUrlCallback) {
            $resetPasswordUrl = call_user_func(static::$createUrlCallback, $user, $this->token);
        } else {
            $resetPasswordUrl = url(config('api-mm.frontend_url') . '/reset-password/' . $this->token . '/' . $user->email);
        }

        return (new MailMessage)
            ->subject('Reset your MigrationAssistant password')
            ->view(
                'emails.register.resetPassword',
                ['name' => $user->first_name, 'resetPasswordUrl' => $resetPasswordUrl]
            );
    }
}
