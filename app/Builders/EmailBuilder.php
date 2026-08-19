<?php

namespace App\Builders;

use App\Support\EmailMessage;

class EmailBuilder
{
    private ?string $to = null;
    private string $subject = '';
    private string $body = '';
    /** @var list<string> */
    private array $cc = [];
    /** @var list<string> */
    private array $attachments = [];

    public function to(string $email)
    {
        $this->to = $email;

        return $this;
    }

    public function subject(string $subject)
    {
        $this->subject = $subject;
        return $this;
    }
    public function body(string $body)
    {
        $this->body = $body;
        return $this;
    }

    public function cc(string $cc)
    {
        $this->cc[] = $cc;
        return $this;
    }

    public function attach(string $doc)
    {
        $this->attachments[] = $doc;
        return $this;
    }

    public function build(): EmailMessage
    {
        if($this->to === null) throw new \InvalidArgumentException("Email recipient is required.");
        
        return new EmailMessage(
            to: $this->to,
            subject: $this->subject,
            body: $this->body,
            cc: $this->cc,
            attachments: $this->attachments
        );
    }
}