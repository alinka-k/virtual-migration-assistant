<?php

namespace App\Models\MyEligibility;

class GeneralMessage
{
    private string $message;
    private ?string $bubble;

    public function __construct(string $message, string $bubble=null)
    {
        $this->message = $message;
        $this->bubble = $bubble;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getBubble(): ?string
    {
        return $this->bubble;
    }
}
